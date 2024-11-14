$(document).ready(function() {
    $('#myForm').on('submit', function(event) {
        console.log("FOrm submitting")
        event.preventDefault(); // Prevent the default form submission
        $('#alert-container').empty(); // Clear previous alerts
    
        // Get form values
        const fname = $('#fname').val().trim();
        console.log(fname)
        // const mname = $('#mname').val().trim();
        const lname = $('#lname').val().trim();
        const dob = $('#dob').val().trim();
        const gender = $('#gender').val().trim();
        const marital_status = $('#marital').val().trim();
        const bgroup = $('#bgroup').val().trim();
        const email = $('#email').val().trim();
        const phone = $('#phone').val().trim();
        const address = $('#address').val().trim();
        const medications = $('#medications').val().trim();

        let isValid = true;
    
        // Username validation
        if (fname === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                First name cannot be empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (lname === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Last name cannot be empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (dob === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Pick Patient's date of birth.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (!validateDOB(dob)) {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Please enter a valid date of birth.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (gender === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Select Patient's gender
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }
        
        if (marital_status === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Choose patient's marital status.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

       if (bgroup === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Choose patient's blood group.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (email === '') {
            console.log("AMa")
            $('#alert-container').append(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email cannot be empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `);
            isValid = false;
            return;
        } 

        if (!validateEmail(email)) {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Please enter a valid email address.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }
        

        if (phone === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Enter a phone number
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (!validatePhone(phone)) {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Please enter a valid phone number. Begin with an the country code.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }

        if (address === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Enter an address
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
            return;
        }


        if (medications === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Enter patient's current medications.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            `);
            isValid = false;
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

    $('#edit').click(function() {
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

    

   
});