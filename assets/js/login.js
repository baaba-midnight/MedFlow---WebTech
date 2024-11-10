$(document).ready(function() {
    $('#myForm').on('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission
        $('#alert-container').empty(); // Clear previous alerts
    
        // Get form values
        const email = $('#email').val().trim();
        const password = $('#password').val().trim();
        let isValid = true;
    
        // Username validation
        if (email === '') {
            $('#alert-container').append(`
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Email cannot be empty.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            `);
            isValid = false;
            return;
        }

        if (password === '') {
            $('#alert-container').append(`
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                Password cannot be empty.
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

    function validateEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
});