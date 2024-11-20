$(document).on('click', '.edit-btn', function() {
// When any "Open" button is clicked
    // Get the patient ID from the button's data-id attribute
    console.log("Button clicked");
//   $('#myModal').modal('show');
    const patientId = $(this).data('id');

    // Send an AJAX request to fetch patient data
    $.ajax({
        url: '../../functions/fill_modal.php?id=' + patientId,  // Replace with your actual API endpoint
        method: 'GET',
        success: function(patient) {
            // Populate the modal with the fetched patient data
            $('#fname').val(patient.first_name);
            $('#mname').val(patient.middle_name);
            $('#lname').val(patient.last_name);
            $('#dob').val(patient.date_of_birth);
            $('#gender').val(patient.gender);
            $('#marital').val(patient.marital_status);
            $('#bgroup').val(patient.blood_group);
            $('#email').val(patient.email);
            $('#phone').val(patient.contact_number);
            $('#address').val(patient.address);
            $('#medications').val();
            $('#status').val(patient.status);


            // Optionally, store the patient ID in the save button for later use
            $('#edit').data('patient-id', patientId);

            // Show the modal
            $('#myModal').modal('show');
        },
        error: function(xhr, status, error) {
            // Handle any errors here (e.g., show an error message)
            alert('Error fetching patient data: ' + error);
        }
    });
});

// $(document).on('click', '.edit-btn', function() {
//     const patientId = $(this).data('id');

//     $.ajax({
//         url: '../../functions/fill_modal.php?id=' + patientId,
//         method: 'GET',
//         success: function(patient) {
//             // Populate modal form fields
//             $('#fname').val(patient.first_name);
//             $('#mname').val(patient.middle_name);
//             $('#lname').val(patient.last_name);
//             $('#dob').val(patient.date_of_birth);
//             $('#email').val(patient.email);
//             $('#phone').val(patient.contact_number);
//             $('#address').val(patient.address);

//             // Show the modal
//             $('#myModal').modal('show');
//         },
//         error: function(xhr, status, error) {
//             console.error('Error fetching patient data:', error);
//         }
//     });
// });
