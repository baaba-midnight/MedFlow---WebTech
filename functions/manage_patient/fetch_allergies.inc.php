<?php
include './includes/config.inc.php';

function getLatestVitals($patient_id) {
    global $conn;

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
        $patient = $result->fetch_assoc();

        if (!$patient) {
            throw new Exception("No patient medications found with specified ID");
        }
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}