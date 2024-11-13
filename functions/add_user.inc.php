<?php
include "../includes/config.inc.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $firstName = trim($_POST['fname']);
    $lastName = trim($_POST['lname']);

    $dob = trim($_POST['dob']);
    $sex = trim($_POST['sex']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);

    // assign the user role
    if (trim($_POST['role']) == 0) {
        $user_role = "admin";
    } elseif (trim($_POST['role']) == 1) {
        $user_role = "doctor";
    } elseif (trim($_POST['role']) == 2) {
        $user_role = "nurse";
    }

    // if user department is not specified then assign "", admin does not have a department
    $user_department = (trim($_POST['department']) != "") ? trim($_POST['department']) : "";
    $licenseNumber = trim($_POST['licenseNumber']);
    $password = trim($_POST['password']);
    $emergency_contact_name = trim($_POST['emergency_contact_name']);
    $emergency_contact_phone = trim($_POST['emergency_contact_phone']);
    
    // hash the password
    $hash_password = password_hash($password, PASSWORD_DEFAULT);

    echo $hash_password;
    if (empty($firstName) || empty($lastName)) {
        die("Enter required fields");
    }

    $query = "INSERT INTO users(first_name, last_name, date_of_birth, gender, email, contact_number, `address`, userrole, user_department, license_number, password, emergency_contact_name, emergency_contact_phone)
         VALUES (?,?,STR_TO_DATE(?, '%Y-%m-%d'),?,?,?,?,?,?,?,?,?,?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param(
        'sssssssssssss',
        $firstName,
        $lastName,
        $dob,
        $sex,
        $email,
        $phone,
        $address,
        $user_role,
        $user_department,
        $licenseNumber,
        $hash_password, // Use the correct variable name
        $emergency_contact_name,
        $emergency_contact_phone
    );

    if ($stmt->execute()) {
        echo "<script>alert('User added succesfully')</script>";
    } else  {
        echo "<script>alert('Unable to add user')</script>";
    }
    $stmt->close();
}
$conn->close();