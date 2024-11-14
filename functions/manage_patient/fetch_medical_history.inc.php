<?php
include './includes/config.inc.php';

function getLatestVitals($patient_id) {
    global $conn;

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
            throw new Exception("No patient vitals found with specified ID");
        }
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}