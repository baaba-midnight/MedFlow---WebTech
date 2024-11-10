<?php

//db connection
include './includes/config.inc.php';


//Check for form data
if($_SERVER["REQUEST_METHOD"] == 'POST'){
    //validate form data(server side)
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $dob = trim($_POST['dob']);
    $gender = trim($_POST['gender-options']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $department = trim($_POST['department-options']);
    $license_number = trim($_POST['license_number']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['password2']);
    $userrole = trim($_POST['role-options']);
    $emergency_name = trim($_POST['emergency_name']);
    $emergency_phone = trim($_POST['emergency_phone']);
    

    //check if fields are empty
    if(empty($fname)||empty($lname)||empty($dob)||empty($gender)|| empty($email)||empty($phone)||empty($address)||empty($department)||empty($license_number)||empty($password)||empty($confirm_password)||empty($userrole)||empty($emergency_name)||empty($emergency_phone)){
        die("Dont leave field empty");
    }

    if ($confirm_password != $password){
        die("Password doesn't match");
    }

    //clean your data before passing it to database. Prevents SQL injection
    $stmt = $conn->prepare('SELECT email from users where email = ?');
    //bind parameters to sql statement
    $stmt->bind_param('s',$email);
    //execute statement
    $stmt -> execute();
    $results = $stmt -> get_result();

    if ($results->num_rows > 0){
        echo "<script> alert('registration failed, user already registered') </script>";
        echo "<script> window.location.href = register.html </script>";
    }else{
        //hash password before inserting into db
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        //Write a prepare statement to insert a new user into db
        $query = 'INSERT INTO Users(first_name,last_name,date_of_birth,gender,email,phone_number,address,userrole,user_department,license_number,user_password,emergency_contact_name,emergency_contact_phone) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?) ';
        $stmt = $conn-> prepare($query);
        $stmt -> bind_param('sssssssssssss',$fname,$lname,$dob,$gender,$email,$phone,$address,$userrole,$department,$license_number,$password,$emergency_name,$emergency_phone);
        
        //if user has been registered redirect to login page

        if($stmt -> execute()){
            header("Location: Login.php");
        }else{
            header("Location: register.html");
        }
    }
    $stmt ->close();
    

}

$conn -> close();
?>