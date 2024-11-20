<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
require_once "../../includes/config.inc.php";

header('Content-Type: application/json');

try {
    $doctor_user_id = $_SESSION['user_id'] ?? null;
    $data = array();
    
    // Assigned patients - count unique patients
    $sql = "SELECT COUNT(DISTINCT p.patient_id) as count 
            FROM Patients p 
            JOIN Appointments a ON p.patient_id = a.patient_id 
            WHERE a.doctor_user_id = '$doctor_user_id'";
    $result = $conn->query($sql);
    $data['assigned_patients'] = $result->fetch_assoc()['count'];

    // Critical patients - count unique critical patients
    $sql = "SELECT COUNT(DISTINCT p.patient_id) as count 
            FROM Patients p 
            JOIN Appointments a ON p.patient_id = a.patient_id 
            WHERE a.doctor_user_id = '$doctor_user_id' AND p.is_critical = 1";
    $result = $conn->query($sql);
    $data['critical_patients'] = $result->fetch_assoc()['count'];

    // Pending tasks - all scheduled appointments today
    $sql = "SELECT COUNT(*) as count 
            FROM Appointments 
            WHERE doctor_user_id = '$doctor_user_id' 
            AND DATE(appointment_date) = CURDATE()";
    $result = $conn->query($sql);
    $data['pending_tasks'] = $result->fetch_assoc()['count'];

    // New consultations - all consultation type appointments
    $sql = "SELECT COUNT(*) as count 
            FROM Appointments 
            WHERE doctor_user_id = '$doctor_user_id' 
            AND appointment_type = 'Consultation'";
    $result = $conn->query($sql);
    $data['new_consultations'] = $result->fetch_assoc()['count'];

    // Today's appointments
    $sql = "SELECT 
                a.appointment_time,
                CONCAT(p.first_name, ' ', p.last_name) as patient_name,
                a.appointment_type,
                a.appoint_condition as status,
                a.appointment_id
            FROM Appointments a
            JOIN Patients p ON a.patient_id = p.patient_id
            WHERE a.doctor_user_id = '$doctor_user_id' 
            AND DATE(a.appointment_date) = CURDATE()
            ORDER BY a.appointment_time";
    $result = $conn->query($sql);
    $data['todays_appointments'] = $result->fetch_all(MYSQLI_ASSOC);

    // Current patients list
    $sql = "SELECT 
                p.patient_id,
                CONCAT(p.first_name, ' ', p.last_name) as patient_name,
                p.gender,
                TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age,
                GROUP_CONCAT(mh.condition_name) as conditions,
                p.status as patient_status
            FROM Patients p
            JOIN Appointments a ON p.patient_id = a.patient_id
            LEFT JOIN MedicalHistory mh ON p.patient_id = mh.patient_id
            WHERE a.doctor_user_id = '$doctor_user_id' 
            AND p.status IN ('inpatient', 'outpatient')
            GROUP BY p.patient_id
            LIMIT 5";
    $result = $conn->query($sql);
    $data['current_patients'] = $result->fetch_all(MYSQLI_ASSOC);

    echo json_encode($data);

} catch (Exception $e) {
    error_log("Error: " . $e->getMessage());
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}
?>