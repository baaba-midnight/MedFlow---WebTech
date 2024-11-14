<?php
include "../includes/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstName = trim($_POST['fname']);
    $middleName = trim($_POST['mname']);
    $lastName = trim($_POST['lname']);

    // die($firstName);

    $dob = trim($_POST['dob']);
    $sex = trim($_POST['sex']);
    // $marialStatus = trim($_POST['marital_status']);

    // $bloodGroup = trim($_POST['blood_group']);
    // $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $status = "inpatient";
    // $medications = trim($_POST['medications']);

    $insuranceProvider = trim($_POST['insuranceProvider']);
    $policyNumber = trim($_POST['policyNumber']);

    if (empty($firstName) || empty($middleName) || empty($lastName)) {
        die("Enter required fields");
    }

    $query = "INSERT INTO patients(first_name, middle_name, last_name, date_of_birth, gender, `status`, contact_number, address, insurance_provider, insurance_policy_number)
                VALUES (?,?,?,STR_TO_DATE(?, '%Y-%m-%d'),?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'ssssssssss',
        $firstName,
        $middleName,
        $lastName,
        $dob,
        $sex,
        $status,
        $phone,
        $address,
        $insuranceProvider,
        $policyNumber
    );

    if ($stmt->execute()) {
        echo "<script>alert('Patient added succesfully')</script>";
    } else  {
        echo "<script>alert('Unable to add patient')</script>";
    }
    $stmt->close();
}
$conn->close();