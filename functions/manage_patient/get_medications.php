<?php
include "./includes/config.inc.php";

header("Content-Type: application/x-www-form-urlencoded");

if (isset($_POST['action']) && $_POST['action'] == 'getAllPatients') {
    $query = "SELECT m.medication_name, m.dosage, m.frequency, m.start_date, m.end_date
              FROM medications m
              ORDER BY m.medication_name";
    
    $result = mysqli_query($conn, $query);
    $patients = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $patients[] = $row;
    }
    
    echo json_encode($patients);
    exit;
}

if (isset($_POST['action']) && $_POST['action'] == 'getPatientMeds') {
    $patient_id = mysqli_real_escape_string($conn, $_POST['patient_id']);
    
    $query = "SELECT m.medication_name, m.dosage, m.frequency, m.start_date, m.end_date
              FROM medications m
              WHERE m.patient_id = '$patient_id'
              ORDER BY m.medication_name";
    
    $result = mysqli_query($conn, $query);
    $medications = array();
    
    while ($row = mysqli_fetch_assoc($result)) {
        $medications[] = $row;
    }
    
    echo json_encode($medications);
    exit;
}
?>