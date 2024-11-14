<?php 
include "../includes/config.inc.php";

// Get recent appointments for dashboard
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $query = "SELECT
                    a.appointment_id,
                    p.first_name as patient_first_name,
                    p.last_name as patient_last_name,
                    u.first_name as doctor_first_name,
                    u.last_name as doctor_last_name,
                    a.appointment_date,
                    a.appointment_time,
                    a.appoint_condition
            FROM Appointments a
            JOIN Patients p ON a.patient_id = p.patient_id
            JOIN Doctors d ON a.doctor_user_id = d.doctor_id
            JOIN Users u ON d.user_id = u.user_id
            ORDER BY a.appointment_date DESC, a.appointment_time DESC
            LIMIT 5;";

    $stmt = $conn->prepare($query);
    $stmt->execute();

    $results = $stmt->get_result();
    $appointments = [];

    if (!empty($results)) {
        while ($row = $results->fetch_assoc()) {
            $appointments[] = $row;
        }

        echo json_encode($appointments);
    } else {
        echo json_encode("No appointments available");
    }

    $stmt->close();
}
$conn->close();