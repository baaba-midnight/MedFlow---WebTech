$(document).ready(function() {
    $('#myForm').on('submit', function(event) {
        console.log("Form submitting")
        event.preventDefault(); // Prevent the default form submission
        $('#alert-container').empty(); // Clear previous alerts
    
        // Get form values
        const fname = $('#fname').val().trim();
        // const mname = $('#mname').val().trim();
        const lname = $('#lname').val().trim();
        const dob = $('#dob').val().trim();
        const gender = $('#gender-options').val().trim();
        const role = $('#role-options').val().trim();
        const department = $('#department-options').val().trim();
        const license = $('#license-number').val().trim();
        const email = $('#email').val().trim();
        const phone = $('#phone').val().trim();
        const address = $('#address').val().trim();
        const password = $('#password').val().trim();
        const confirm_password = $('#password2').val().trim();
        const emergency_contact = $('#emergency_phone').val().trim();
        const emergency_name = $('#emergency_name').val().trim();


        let isValid = true;
    
        // Username validation
        if (fname === '') {
            showAlert("First name cannot be empty.");
            return;
        }

        if (lname === '') {
            showAlert("Last name cannot be empty.");
            return;
        }

        if (dob === '') {
            showAlert("Pick Patient's date of birth.");
            return;
        }

        if (!validateDOB(dob)) {
            showAlert("Please enter a valid date of birth.");
            return;
        }

        if (gender === '') {
            showAlert("Select Patient's Gender");
            return;
        }

        if (email === '') {
            showAlert("Email cannot be empty.");
            return;
            console.log("AMa")
        }

        if (!validateEmail(email)) {
            showAlert("Please enter a valid email address.");
            return;
        }

        if (phone === '') {
            showAlert("Enter a phone number.");
            return;
        }

        if (!validatePhone(phone)) {
            showAlert("Please enter a valid phone number. Begin with an the country code.");
            return;
        }

        if (address === '') {
            showAlert("Enter an address");
            return;
        }

        if (role === '') {
            showAlert("Choose a role.");
            return;
        }

        if (department === '') {
            showAlert("Choose a department.");
            return;
        } 

        if (license === '') {
            showAlert("Enter your license number.");
            return;
        }

        if (password === '') {
            showAlert("Enter a password.");
            return;
        }

        if (confirm_password === '') {
            showAlert("Confirm your password.");
            return;
        }

        if (password != confirm_password) {
            showAlert("Password mismatch!");
            return;
        }

        if (emergency_name === '') {
            showAlert("Emergency contact name cannot be empty.");
            return;
        }

        if (emergency_contact === '') {
            showAlert("Emergency contact phone number cannot be empty.");
            return;
        }
        

        if (isValid) {
            $('#alert-container').append(`
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                  Form submitted successfully!
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              `);
            this.submit();
        }

    });


    

    $('#register').click(function() {
        console.log("Button Clicked")
        $('#myForm').submit();
    });

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }

    function validateDOB(dob) {
        const dateRegex = /^\d{4}-([0]?[1-9]|1[0-2])-([0]?[1-9]|[12]\d|3[01])$/;
        return dateRegex.test(dob);
    }

    function validatePhone(phone) {
        const dateRegex = /^\+?[1-9]\d{1,14}$/;
        return dateRegex.test(phone);
    }

    function showAlert(message) {
        $('#alert-container').append(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `);
        
        $('.form-container').scrollTop(0);

        isValid = false;
    }

    

    

   
});