<?php 
require_once '../../includes/config.inc.php';

header('Content-Type: application/json');
error_reporting(E_ALL);
ini_set('display_errors', 1);

function sendResponse($data, $statusCode=200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function handleError($e) {
    sendResponse(['error' => 'Database error: ' . $e->getMessage()], 500);
}

// get patient basic information
function getBasicInfoById($patient_id) {
    global $conn;

    try {
        $query = "SELECT
                CONCAT(p.first_name, ' ', p.last_name) as full_name,
                p.patient_id,
                p.gender,
                TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age,
                p.status,
                p.admission_date,
                p.contact_number as phone,
                p.address
            FROM Patients p
            WHERE p.patient_id = ?";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patient = $result->fetch_assoc();

            if (!$patient) {
                throw new Exception("No patient found with specified ID");
            }
            return $patient;
        }
    } catch (Exception $e) {
        handleError($e);
    }

    $stmt->close();
    $conn->close();
}

function getCurrentMeds($patient_id) {
    global $conn;

    try {
        $query = "SELECT 
                m.medication_name,
                m.dosage,
                m.frequency,
                m.start_date,
                m.end_date,
                CONCAT(u.first_name, ' ', u.last_name) as prescribed_by_doctor
            FROM Medications m
            JOIN Doctors d ON m.prescribed_by = d.doctor_id
            JOIN Users u ON d.user_id = u.user_id
            WHERE m.patient_id = ?
            AND m.medi_condition = 'active';";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patientMeds = $result->fetch_assoc();

            if (!$patientMeds) {
                return "No patient medications found with specified ID";
            }
            return $patientMeds;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getLabResults($patient_id) {
    global $conn;

    try {
        $query = "SELECT 
                lr.test_type,
                lr.test_date,
                lr.result,
                lr.normal_range,
                CONCAT(u.first_name, ' ', u.last_name) as performed_by,
                lr.notes
            FROM LabResults lr
            JOIN Staff s ON lr.performed_by = s.staff_id
            JOIN Users u ON s.user_id = u.user_id
            WHERE lr.patient_id = ?
            ORDER BY lr.test_date DESC;";

            $stmt = $conn->prepare($query);
            $stmt->bind_param('s', $patient_id);

            if ($stmt->execute()) {
                $result = $stmt->get_result();
                $patientLabResults = $result->fetch_assoc();

                if (!$patientLabResults) {
                    return "No patient lab results found with specified ID";
                }

                return $patientLabResults;
            }

            $stmt->close();
            $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getAllergies($patient_id) {
    global $conn;

    try {
        $query = "SELECT 
            a.allergy_type,
            a.severity,
            a.notes
        FROM Allergies a
        WHERE a.patient_id = ?;";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patientAllergies = $result->fetch_assoc();

            if (!$patientAllergies) {
                return "No patient allergies found with specified ID";
            }
            return $patientAllergies;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getAppointments($patient_id) {
    global $conn;

    try {
        $query = "SELECT 
                a.appointment_date,
                a.appointment_time,
                a.appointment_type,
                a.room_number,
                CONCAT(u.first_name, ' ', u.last_name) as doctor_name,
                a.notes,
                a.appoint_condition
            FROM Appointments a
            JOIN Doctors d ON a.doctor_user_id = d.doctor_id
            JOIN Users u ON d.user_id = u.user_id
            WHERE a.patient_id = ?
            AND a.appointment_date >= CURDATE()
            AND a.appoint_condition = 'scheduled'
            ORDER BY a.appointment_date, a.appointment_time;";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patient = $result->fetch_assoc();

            if (!$patient) {
                return "No patient appointments found with specified ID";
            }
            return $patient;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getMedicalHistory($patient_id) {
    global $conn;

    try {
        $query = "SELECT 
                mh.condition_name,
                mh.diagnosis_date,
                mh.case_condition,
                mh.notes
            FROM MedicalHistory mh
            WHERE mh.patient_id = ?
            AND mh.case_condition = 'active';";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patient = $result->fetch_assoc();

            if (!$patient) {
                return "No medical history found for patient with specified ID";
            }
            return $patient;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getLatestVitals($patient_id) {
    global $conn;

    try {
        $query = "SELECT
                v.blood_pressure,
                v.heart_rate,
                v.temperature,
                CONCAT(u.first_name, ' ', u.last_name) as recorded_by,
                v.recorded_date
            FROM Vitals v
            JOIN Users u ON v.recorded_by = u.user_id
            WHERE v.patient_id = ?
            ORDER BY v.recorded_date DESC
            LIMIT 1;";

        $stmt = $conn->prepare($query);
        $stmt->bind_param('s', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patient = $result->fetch_assoc();

            if (!$patient) {
                return "No patient vitals found with specified ID";
            }
            return $patient;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

// handle main routing
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $data = [
        'BasicInfo' => getBasicInfoById($_GET['id']),
        'CurrentMeds' => getCurrentMeds($_GET['id']),
        'LabResults' => getLabResults($_GET['id']),
        'Allergies' => getAllergies($_GET['id']),
        'Appointments' => getAppointments($_GET['id']),
        'MedicalHistory' => getMedicalHistory($_GET['id']),
        'Vitals' => getLatestVitals($_GET['id'])
    ];

    sendResponse($data);
}