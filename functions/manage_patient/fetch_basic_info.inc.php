<?php
include './includes/config.inc.php';

function getBasicPatientInfo($patient_id) {
    global $conn;

    $query = "SELECT
                CONCAT(p.first_name, ' ', p.last_name) as full_name,
                p.patient_id,
                p.gender,
                TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) as age,
                p.status,
                p.admission_date,
                p.contact_number as phone,
                p.emergency_contact_number as emergency_phone,
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
        echo json_encode($patient);
    }

    $stmt->close();
    $conn->close();
}