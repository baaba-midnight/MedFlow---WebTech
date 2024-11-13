<?php
include './includes/config.inc.php';

function getLatestVitals($patient_id) {
    global $conn;

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
            throw new Exception("No patient medications found with specified ID");
        }
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}