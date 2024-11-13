<?php
include './includes/config.inc.php';

function getLatestVitals($patient_id) {
    global $conn;

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
            throw new Exception("No patient vitals found with specified ID");
        }
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}