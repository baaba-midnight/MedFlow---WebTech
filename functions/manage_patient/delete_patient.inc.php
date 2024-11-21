<?php
include "../../includes/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $patientID = $_GET['id'];

    if (empty($patientID)) {
        error_log("No recieved id");
        echo "error_fields";
        exit;
    }

    $query = "DELETE FROM patients WHERE patient_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param('s', $patientID);

    if ($stmt->execute()) {
        echo "success";
    } else  {
        echo "error_delete";
    }
    $stmt->close();
}
$conn->close();