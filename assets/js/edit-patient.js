document.addEventListener("DOMContentLoaded", function() { 
    document.addEventListener("click", function(e) {
        if (e.target.classList.contains('edit-btn')) {
            const row = e.target.closest('tr');

            if (row) {
                const patientId = row.getAttribute("data-id");

                if (!patientId) {
                    console.error('No patient ID found');
                    return;
                } else {
                
                    console.log(`Your id is ${patientId}`);
                    
                    fetch(`../../functions/fetch_patient.inc.php?id=${encodeURIComponent(patientId)}`)
                        .then(response => {
                            console.log("Response status:", response.status);
                            if (response.ok) {
                                return response.json();
                            }
                            throw new Error(`HTTP error! status: ${response.status}`);
                        })
                        .then(data => {
                            console.log("Data received:", data);
                            if (!data) {
                                throw new Error('No data received');
                            }
                            openPatientModal('edit', data);
                        })
                        .catch(error => {
                            console.error('Error fetching patient data:', error);
                            alert('Failed to load patient data. Please try again.');
                        });
                }
            }
        } else {
            console.error("No data-id attribute found on the row.");
        }
    });
});

function openPatientModal(mode, patientData = null) {
    const modalTitle = document.getElementById("modalTitle");
    const submitBtn = document.getElementById("submitBtn");

    if (mode === "edit" && patientData) {
        modalTitle.innerText = "Edit Patient";
        submitBtn.innerText = "Save Changes";

        // populate modal fields with patient data
        document.getElementById('fname').value = patientData.first_name;
        document.getElementById('mname').value = patientData.middle_name;
        document.getElementById('lname').value = patientData.last_name;

        document.getElementById('dob').value = patientData.date_of_birth;
        document.getElementById('sex').value = patientData.sex;
        document.getElementById('marital_status').value = patientData.marital_status;
        document.getElementById('blood_group').value = patientData.blood_group;

        document.getElementById('email').value = patientData.email;
        document.getElementById('phone').value = patientData.contact_number;
        document.getElementById('address').value = patientData.address;
        document.getElementById('medications').value = patientData.medications;
        document.getElementById('insuranceProvider').value = patientData.insurance_provider;
        document.getElementById('policyNumber').value = patientData.insurance_policy_number;
    } else  {
        modalTitle.innerText = "Add New Patient";
        submitBtn.innerText = "Add Patient";

        // clear modal fields for new patient
        document.getElementById('fname').value = "";
        document.getElementById('mname').value = "";
        document.getElementById('lname').value = "";

        document.getElementById('dob').value = "";
        document.getElementById('sex').value = "";
        document.getElementById('marital_status').value = "";
        document.getElementById('blood_group').value = "";

        document.getElementById('email').value = "";
        document.getElementById('phone').value = "";
        document.getElementById('address').value = "";
        document.getElementById('medications').value = "";
        document.getElementById('insuranceProvider').value = "";
        document.getElementById('policyNumber').value = "";
    }

    // show the modal using Bootstrap
    $('#myModal').modal('show');
}