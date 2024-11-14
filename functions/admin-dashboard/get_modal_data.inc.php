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

// get active patients details
function getPatients() {
    global $conn;

    try {
        $query = "SELECT DISTINCT
                    p.patient_id,
                    CONCAT(p.first_name, ' ', p.last_name) as full_name,
                    p.admission_date,
                    d.department_name,
                    CONCAT(u.first_name, ' ', u.last_name) as doctor_name
                FROM Patients p
                JOIN Appointments a ON p.patient_id = a.patient_id
                JOIN Doctors doc ON a.doctor_user_id = doc.doctor_id
                JOIN Users u ON u.user_id = doc.doctor_id
                JOIN Departments d ON doc.department_id = d.department_id
                WHERE p.status IN ('inpatient', 'outpatient')
                ORDER BY p.admission_date DESC;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $patientActive = [];
            
        while($row = $result->fetch_assoc()) {
            $patientActive[] = [
                'patientId' => $row['patient_id'],
                'name' => $row['full_name'],
                'admissionDate' => $row['admission_date'],
                'department' => $row['department_name'],
                'doctor' => $row['doctor_name']
            ];
        }
        
        return $patientActive;
    } catch (Exception $e) {
        handleError($e);
    }
}

function getCriticalPatients() {
    global $conn;
    try {
        // get critical patients
        $query = "SELECT DISTINCT
                    p.patient_id,
                    CONCAT(p.first_name, ' ', p.last_name) as full_name,
                    mh.condition_name,
                    mh.case_condition
                FROM 
                    Patients p
                    LEFT JOIN Appointments a ON p.patient_id = a.patient_id
                    LEFT JOIN MedicalHistory mh ON p.patient_id = mh.patient_id
                WHERE 
                    p.is_critical = TRUE
                    ;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $patientCritical = [];
        while($row = $result->fetch_assoc()) {
            $patientCritical[] = [
                'patientId' => $row['patient_id'],
                'name' => $row['full_name'],
                'condition' => $row['condition_name'],
                'status' => $row['case_condition']
            ];
        } 

        return $patientCritical;
    } catch (Exception $e) {
        handleError($e);
    }
}

// get appointment data
function getAppointments() {
    global $conn;

    try {
        $query = "SELECT
                    a.appointment_date,
                    a.appointment_time,
                    CONCAT(p.first_name, ' ', p.last_name) as patient_name,
                    CONCAT(u.first_name, ' ', u.last_name) as doctor_name,
                    a.appoint_condition
                FROM Appointments a
                JOIN Users u ON u.user_id = a.doctor_user_id
                JOIN Patients p ON p.patient_id = a.patient_id
                JOIN Doctors d ON a.doctor_user_id = d.doctor_id;";

        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $patientAppointments = [];
    
        while($row = $result->fetch_assoc()) {
            $patientAppointments[] = [
                'date' => $row['appointment_date'],
                'time' => $row['appointment_time'],
                'patient' => $row['patient_name'],
                'doctor' => $row['doctor_name'],
                'status' => $row['appoint_condition']
            ];
        } 
        return $patientAppointments;
    } catch (Exception $e) {
        handleError($e);
    }
}

function getStaff() {
    global $conn;

    try {
        $query = "SELECT
                    CONCAT(first_name, ' ', last_name) as full_name,
                    email,
                    userrole,
                    user_department as department
                FROM Users;";
            
        $stmt = $conn->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();

        $staff = [];
        while($row = $result->fetch_assoc()) {
            $staff[] = [
                'name' => $row['full_name'],
                'email' => $row['email'],
                'role' => $row['userrole'],
                'department' => $row['department'],
            ];
        }

        return $staff;
    } catch (Exception $e) {
        handleError($e);
    }
}

// maing routing
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $type = $_GET['type'] ?? '';

    switch($type) {
        case 'patients':
            sendResponse(getPatients());
            break;
        case 'critical':
            sendResponse(getCriticalPatients());
            break;
        case 'staff':
            sendResponse(getStaff());
            break;
        case 'appointments':
            sendResponse(getAppointments());
            break;
        default:
            sendResponse(['error' => 'Invalid type specified'], 400);
    }
} else {
    sendResponse(['error' => 'Invalid request method'], 405);
}