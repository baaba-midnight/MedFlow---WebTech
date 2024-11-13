<?php 
include "../includes/config.inc.php";

// Get recent appointments for dashboard
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT 
                u.user_id,
                CONCAT(u.first_name, ' ', u.last_name) AS `Full Name`,
                u.email,
                u.phone_number,
                u.userrole,
                u.user_department
            FROM Users u
            ORDER BY u.user_id;";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $results = $stmt->get_result();
    $users = [];

    if (!empty($results)) {
        while ($row = $results->fetch_assoc()) {
            $users[] = $row;
        }

        echo json_encode($users);
    } else {
        echo json_encode("No users available");
    }

    $stmt->close();
}
$conn->close();