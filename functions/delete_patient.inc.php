<?php
include "../includes/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $patientID = $_GET['id'];

    if (empty($patientID)) {
        die("Enter required fields");
    }

    $query = "DELETE FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $patientID);

    if ($stmt->execute()) {
        echo "<script>alert('Patient deleted succesfully')</script>";
    } else  {
        echo "<script>alert('Unable to delete patient')</script>";
    }
    $stmt->close();
}
$conn->close();