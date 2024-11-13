<?php 
include '../includes/config.inc.php';

header('Content-Type: application/json');

try {
    if (!isset($_GET['id'])) {
        throw new Exception("Missing user ID", 400);
    }

    $userId = (int) $_GET['id'];
    
    $stmt = $conn->prepare("SELECT * FROM Users WHERE `user_id` = ?");
    if (!$stmt) {
        throw new Exception("Failed to prepare statement", 500);
    }

    $stmt->bind_param('i', $userId);
    
    if (!$stmt->execute()) {
        throw new Exception("Failed to execute query", 500);
    }

    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if (!$user) {
        throw new Exception("No user found with specified ID", 404);
    }

    echo json_encode($user);

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