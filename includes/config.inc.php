<?php
$servername = 'localhost';
$username = 'root';
$dbname = 'hospital_management';
$password = '';

$conn = new mysqli(
    $servername,
    $username,
    $password,
    $dbname
) or die('Connection Failed' . $conn);

if ($conn->connect_error) {
    die("Connected Failed" . $conn);
} else {
    // do nothing
}
?>