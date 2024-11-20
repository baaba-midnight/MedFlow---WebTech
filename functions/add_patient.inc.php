<?php
include "../includes/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstName = trim($_POST['fname']);
    $middleName = trim($_POST['mname']);
    $lastName = trim($_POST['lname']);

    // die($firstName);

    $dob = trim($_POST['dob']);
    $sex = trim($_POST['gender']);
    $marialStatus = trim($_POST['marital']);

    $bloodGroup = trim($_POST['bgroup']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $status = "inpatient";
    $medications = trim($_POST['medications']);

    if (empty($firstName) || empty($middleName) || empty($lastName)) {
        die("Enter required fields");
    }

    $query = "INSERT INTO patients(first_name, middle_name, last_name, email, date_of_birth, gender, marital_status, blood_group, `status`, contact_number, address)
                VALUES (?,?,?,?,STR_TO_DATE(?, '%Y-%m-%d'),?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'ssssssssss',
        $firstName,
        $middleName,
        $lastName,
        $email,
        $dob,
        $sex,
        $marialStatus,
        $bloodGroup,
        $status,
        $phone,
        $address
    );

    if ($stmt->execute()) {
        echo "<script>alert('Patient added succesfully')</script>";
    } else  {
        echo "<script>alert('Unable to add patient')</script>";
    }
    $stmt->close();
}
$conn->close();