<?php 
require_once '../../includes/config.inc.php';

function sendResponse($data, $statusCode=200) {
    http_response_code($statusCode);
    echo json_encode($data);
    exit;
}

function handleError($e) {
    sendResponse(['error' => 'Database error: ' . $e->getMessage()], 500);
}

// get patient basic information
function getBasicInfoById($conn, $patient_id) {
    $stmt = null; // Initialize to ensure it exists in finally block

    try {
        $query = "SELECT 
                CONCAT(p.first_name, ' ', p.last_name) as full_name,
                p.patient_id,
                TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age, 
                p.gender,
                p.email,
                p.contact_number,
                GROUP_CONCAT(DISTINCT ds.department_name) as departments,
                p.`status`,
                p.admission_date
            FROM Patients p
            LEFT JOIN Appointments a ON p.patient_id = a.patient_id
            LEFT JOIN Doctors d ON a.doctor_user_id = d.doctor_id
            LEFT JOIN doctordepartment dd ON d.doctor_id = dd.doctor_id
            LEFT JOIN departments ds ON dd.department_id = ds.department_name
            WHERE p.patient_id = ?
            GROUP BY p.patient_id";

        $stmt = $conn->prepare($query);

        $patient_id = (int) $patient_id;
        $stmt->bind_param('i', $patient_id);

        if ($stmt->execute()) {
            $result = $stmt->get_result();
            $patient = $result->fetch_assoc();

            if (!$patient) {
                throw new Exception("No patient found with specified ID");
            }
            return $patient;
        } else {
            throw new Exception("Query execution failed: " . $stmt->error);
        }
        
        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getCurrentMeds($conn, $patient_id) {

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
            $patientMeds = [];

            while ($row = $result->fetch_assoc()) {
                $patientMeds[] = $row;
            }

            if (empty($patientMeds)) {
                return "No patient medications found with specified ID";
            }

            $stmt->close();
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

function getLabResults($conn, $patient_id) {
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
                $patientLabResults = [];

                while ($row = $result->fetch_assoc()) {
                    $patientLabResults[] = $row;
                }

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

function getAllergies($conn, $patient_id) {

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
            $patientAllergies = [];

            while ($row = $result->fetch_assoc()) {
                $patientAllergies[] = $row;
            }

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

function getAppointments($conn, $patient_id) {

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

function getMedicalHistory($conn, $patient_id) {
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
            $medical_history = [];

            while ($row = $result->fetch_assoc()) {
                $medical_history[] = $row;
            }

            if (empty($medical_history)) {
                return "No medical history found for patient with specified ID";
            }

            $stmt->close();
            return $medical_history;
        }

        $stmt->close();
        $conn->close();
    } catch (Exception $e) {
        handleError($e);
        $stmt->close();
        $conn->close();
    }
}

function getLatestVitals($conn, $patient_id) {
    try {
        $query = "SELECT
                v.blood_pressure,
                v.heart_rate,
                v.temperature
            FROM Vitals v
            WHERE v.patient_id = ?
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
        'BasicInfo' => getBasicInfoById($conn, $_GET['id']),
        'CurrentMeds' => getCurrentMeds($conn, $_GET['id']),
        'LabResults' => getLabResults($conn, $_GET['id']),
        'Allergies' => getAllergies($conn, $_GET['id']),
        'Appointments' => getAppointments($conn, $_GET['id']),
        'MedicalHistory' => getMedicalHistory($conn, $_GET['id']),
        'Vitals' => getLatestVitals($conn, $_GET['id'])
    ];

    sendResponse($data);
}