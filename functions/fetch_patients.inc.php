<?php 
include '../includes/config.inc.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] == 'GET') {
    $query = "SELECT
            p.patient_id AS `Patient ID`,
            p.first_name,
            p.middle_name,
            p.last_name,
            p.email,
            p.date_of_birth,
            p.marital_status,
            p.blood_group,
            p.contact_number,
            p.address,
            p.date_of_birth AS Age,
            p.gender AS Gender,
            p.admission_date AS `Admission Date`,
            p.`status` AS Status,
            mh.condition_name AS `Primary Diagnosis`,
            m.medication_name
        FROM Patients p
        LEFT JOIN MedicalHistory mh ON p.patient_id = mh.patient_id
        LEFT JOIN Medications m ON p.patient_id = m.patient_id
        WHERE mh.case_condition = 'active'
        ORDER BY p.patient_id;";

    // Ensure the query was prepared successfully
    if ($stmt = $conn->prepare($query)) {
        $stmt->execute();
        $results = $stmt->get_result();
        $patients = [];

        // Use num_rows to check if results are available
        if ($results->num_rows > 0) {
            while ($row = $results->fetch_assoc()) {
                $patients[] = $row;
            }
            echo json_encode($patients);
        } else {
            echo json_encode(["message" => "No patients available"]);
        }

        $stmt->close();
    } else {
        // Error in preparing statement
        echo json_encode(["message" => "Query preparation failed"]);
    }

    $conn->close();
} else {
    echo json_encode(["message" => "Invalid request method"]);
}