<?php
include "../includes/config.inc.php";

// get search term and type
$searchTerm = strtolower(($_GET['q']));
$searchType = $_GET['type'];

if ($searchType === 'patients') {
    $sql = "SELECT * FROM patients
            WHERE LOWER(name) LIKE '%$searchTerm%' OR
            LOWER(condition) LIKE '%$searchTerm%' OR 
            id LIKE '%$searchTerm%'";
    
} elseif ($searchType === 'users') {
    $sql = "SELECT * FROM users WHERE
            LOWER(name) LIKE '%$searchTerm%' OR
            LOWER(condition) LIKE '%$searchTerm%' OR
            id LIKE '%$searchTerm%'";
} else {
    echo json_encode([]);
    exit;
}
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

echo json_encode($data);
$conn->close();

// search patient by name of ID
// $query = "SELECT DISTINCT
//             p.patient_id,
//             p.first_name,
//             p.middle_name,
//             p.last_name,
//             p.date_of_birth,
//             p.gender,
//             p.status
//         FROM Patients p
//         WHERE
//             p.first_name LIKE '%[search_term]%' OR
//             p.last_name LIKE '%[search_terms]%' OR
//             p.patient_id = '[search_item]';";

// search users ny name, role, or department
// $query = "SELECT
//             u.user_id,
//             u.first_name,
//             u.last_name,
//             u.userrole,
//             u.user_department
//         FROM Users u
//         WHERE 
//             u.first_name LIKE '%[search_item]%' OR
//             u.last_name LIKE '%[search_item]%' OR
//             u.userrole LIKE '%[search_item]%' OR
//             u.user_department LIKE '%[search_item]%';";