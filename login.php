<?php
include './includes/config.inc.php';

session_start();

if($_SERVER["REQUEST_METHOD"] == 'POST'){
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    //check if fields are empty
    if(empty($email)||empty($password)){
        die("Dont leave field empty");
    }

    $query = 'SELECT user_id,user_password, userrole FROM Users WHERE email = ?';
    $stmt = $conn -> prepare($query);
    $stmt->bind_param('s',$email);
    $stmt->execute();
    $results = $stmt -> get_result();

    if($results -> num_rows > 0){
        //ideally you would have looped through it but because we know it is just one record in the db that is why we do this.
        $row = $results -> fetch_assoc();
        $user_id = $row['user_id'];
        $user_password = $row['user_password'];
        $user_role = $row['userrole'];

        if (true){
            $_SESSION['id'] = $user_id;
            $_SESSION['userrole'] = $user_role;
            if ($user_role == 'Nurse'){
                header("Location: ./modules/nurse/dashboard.php");
            }elseif($user_role == 'Doctor'){
                header("Location: ./modules/doctor/dashboard.php");
            }elseif($user_role == 'Admin'){
                header("Location: ./modules/admin/dashboard.php");
                echo "<h1>REGULAR</h1>";
            }else{
                header("Location: login.php");
            }
            exit();
        }
    }else {
        // Show an alert if the user is not registered
        echo '<script>alert("User not registered.");</script>';
    }
    $stmt -> close();
}
$conn -> close();

?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Montserrat:ital,wght@0,100..900;1,100..900&family=Playwrite+DE+Grund:wght@100..400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/login.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="main-box">

        <div class="image-container d-none d-lg-block">
            <img src="./assets/images/doctors.jpg" alt="">
        </div>
        
        <div class="form-container">
            <div>
                <a href="./index.php" class="logo-home">
                    <div class="logo">
                        <img class="responsive-img" src="./assets/images/medflow-logo.png" widtth="300" height="200" alt="MedFlow-logo">
                    </div>
                </a>
            </div>
            
            <div class="mt-5 ms-md-5 ms-lg-5 ms-sm-3" style="width: 80%;">
                <div id="alert-container"></div>
                <form id="myForm" method="POST" action="login.php">                    
                        <label for="email" class="form-label"><b>Email</b></label>
                        <input type="email" id="email" name="email" placeholder="Enter your Email" class="custom" required>
                        <span ></span>
                        <label for="password" class="form-label"><b>Password</b></label>   
                        <input type="password" name="password" id="password" placeholder="Enter your password" class="custom" required>
                        <span ></span>
                        <button class="btn mt-4">Login</button>
                </form> 
            </div>

            
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/login.js"></script>
</body>
</html>