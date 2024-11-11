<?php 
include '../../includes/config.inc.php';

function getPatientsFromDatabase() {
    global $conn;

    $query = "SELECT 
    p.patient_id AS id,
    CONCAT(p.first_name, ' ', p.last_name) AS name,
    TIMESTAMPDIFF(YEAR, p.date_of_birth, CURDATE()) AS age,
    p.admission_date,
    d.department_name AS department,
    mh.condition_name AS diagnosis,
    p.status
FROM 
    Patients p
JOIN 
    MedicalHistory mh ON p.patient_id = mh.patient_id
JOIN 
    Doctors doc ON mh.patient_id = p.patient_id
JOIN 
    DoctorDepartment dd ON doc.doctor_id = dd.doctor_id
JOIN 
    Departments d ON dd.department_id = d.department_id
ORDER BY id ASC;";
    $result = $conn->query($query);

    if (!$result) {
        echo "Error: " . $conn->error;
        return [];
    }

    $patients = [];
    while ($row = $result->fetch_assoc()) {
        $patients[] = $row;
    }

    return $patients;
}