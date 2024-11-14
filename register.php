<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Roboto Font Style -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/register.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <div class="main-box">

        <div class="image-container">
            <img src="./assets/images/doctors.jpg" alt="doctors">
        </div>
        
        <div class="form-container">
            <div class="logo-home">
                <a href="/index.php" >
                    <div class="logo">
                        <img src="./assets/images/medflow-logo.png" widtth="300" height="200" alt="MedFlow-logo">
                    </div>
                </a>
            </div>

            <h6>Medical Staff Registration</h6>
            <p>Please fill in your information to create an account</p>
            <div id="alert-container">
            </div>
            <form id="myForm" action = "#" method = "POST">
                <!-- Personal Information -->
                <div>
                    <h6>Personal Information</h6>
                    <div class="form-box">
                        <label>First Name *</label>
                        <input type="text" placeholder="Enter first name" name="fname" id="fname" required>

                        <label>Last Name *</label>
                        <input type="text" placeholder="Enter last name" name="lname" id="lname" required>

                        <label>Date of Birth *</label>
                        <input type="date" placeholder="mm/dd/yyyy" name="dob" id="dob" required>

                        <label>Gender *</label>
                        <select name="gender-options" id="gender-options" class="form-select" required>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <!-- Contact Information -->
                <div>
                    <h6>Contact Information</h6>
                    <div class="form-box">
                        <label>Email Address *</label>
                        <input type="text" placeholder="Enter email address" name="email" id="email" required>

                        <label>Phone Number *</label>
                        <input type="text" placeholder="Enter phone number" name="phone" id="phone" required>

                        <label>Address *</label>
                        <textarea placeholder="Enter your address" name="address" id="address" required></textarea>

                        <label>Role *</label>
                        <select name="role-options" id="role-options" class="form-select">
                            <option value="Doctor">Doctor</option>
                            <option value="Nurse">Nurse</option>
                        </select>

                        <label>Department *</label>
                        <select name="department-options" id="department-options" class="form-select">
                            <option value="ED/A&E">Emergency department</option>
                            <option value="OPD">Outpatient Department</option>
                            <option value="Internal Medicine">Internal Medicine</option>
                            <option value="Surgery">Surgery Department</option>
                            <option value="Pediatrics">Pediatrics</option>
                            <option value="Obstetrics and Gynecology">Obstetrics and Gynecology</option>
                            <option value="Pharmacy">Pharmacy</option>
                            <option value="Diagnostic Services">Diagnostic Services</option>
                        </select>

                        <label>License Number *</label>
                        <input type="text" id="license-number" name = "license_number" placeholder="Enter professional license number" required>
                    </div>
                </div>

                <!-- Account Information -->
                <div>
                    <h6>Account Information</h6>
                    <div class="form-box">
                        <label>Password *</label>
                        <input placeholder="Enter password" type="password" name="password" id="password" required>

                        <label>Confirm Password *</label>
                        <input placeholder="Confirm Password" type="password" name = "password2" id="password2" required>    
                    </div>
                </div>

                <!-- Emergency Contact -->
                <div>
                    <h6>Emergency Contact</h6>
                    <div class="form-box">
                        <label>Emergency Contact Name</label>
                        <input placeholder="Enter emergency contact name" name = "emergency_name" id="emergency_name" type="text">

                        <label>Emergency Contact Phone</label> 
                        <input placeholder="Enter emergency contact number" name = "emergency_phone" id="emergency_phone">
                    </div>
                </div>
            
            </form>
                <button id="register" class="btn mt-4">Register</button>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./assets/js/register.js"></script>
</body>
</html>