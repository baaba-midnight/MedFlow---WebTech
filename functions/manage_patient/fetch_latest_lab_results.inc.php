<?php
include './includes/config.inc.php';

function getLatestVitals($patient_id) {
    global $conn;

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
        $patient = $result->fetch_assoc();

        if (!$patient) {
            throw new Exception("No patient medications found with specified ID");
        }
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}