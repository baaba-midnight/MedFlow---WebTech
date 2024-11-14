<?php
include './includes/config.inc.php';

function getLatestVitals($patient_id) {
    global $conn;

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
        $patient = $result->fetch_assoc();

        if (!$patient) {
            throw new Exception("No patient medications found with specified ID");
        }
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}