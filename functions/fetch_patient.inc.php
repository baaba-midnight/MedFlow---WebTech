<?php 
include '../includes/config.inc.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id'])) {
        throw new Exception("Missing patient ID", 400);
    }

    $patientId = (int) $_GET['id'];

    echo $patientId;
    
    $stmt = $conn->prepare("SELECT * FROM patients WHERE patient_id = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement", 500);
    }

    $stmt->bind_param('i', $patientId);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute query", 500);
    }

    $result = $stmt->get_result();
    $patient = $result->fetch_assoc();

    if (!$patient) {
        throw new Exception("No patient found with specified ID", 404);
    }

    echo json_encode($patient);

} catch (Exception $e) {
    http_response_code($e->getCode() ?: 500);
    echo json_encode(["error" => $e->getMessage()]);
} finally {
    if (isset($stmt)) {
        $stmt->close();
    }
    if (isset($conn)) {
        $conn->close();
    }
}