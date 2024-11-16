

function calculateAge(birthDateString) {
    const birthDate = new Date(birthDateString);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    const dayDifference = today.getDay() - birthDate.getDay();

    if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
        age--;
    }
    return age;
}

// Fetch the JSON data from the PHP script
fetch('../../functions/fetch_patients.inc.php')
.then(response => response.json())
.then(data => {
    // Check if data is an array (contains patients) or if it's an error message
    if (Array.isArray(data)) {
        // Populate the table with the patient data
        const tableBody = document.getElementById('patientTable').querySelector('tbody');
        const modals = document.getElementById('modals')
        data.forEach(patient => {
            const row = document.createElement('tr');
            const modal = document.createElement('div');


            row.setAttribute('data-id', patient["Patient ID"]);
            // console.log(patient["Patient ID"]);
            age = calculateAge(patient["Age"])

            console.log(age);
            fullName = patient["first_name"] + ' ' + patient["last_name"]
            console.log(patient['first_name']);
            

            row.innerHTML = `
                <td>${patient["Patient ID"]}</td>
                <td>${fullName}</td>
                <td>${age}</td>
                <td>${patient["Gender"]}</td>
                <td>${patient["Admission Date"]}</td>
                <td><div class="status ${patient["Status"]}">${patient["Status"]}</div></td>
                <td>${patient["Primary Diagnosis"]}</td>
                <td>
                    <div class="selected-actions" id="selectedActions">
                        <button type="button" class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#myModal${patient["Patient ID"]}" onclick="openPatientModal()">
                            <span class="action-icon">✏️</span> Edit
                        </button>
                        <button class="action-btn remove-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">
                            <span class="action-icon">🗑️</span> Remove
                        </button>
                        <button class="action-btn open-btn" data-bs-toggle="modal" data-bs-target="#displayModal">
                            <span class="action-icon">📂</span> Open
                        </button>
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal${patient["Patient ID"]}">Open modal</button> -->
                    </div>
                </td>
            `;
            tableBody.appendChild(row);

            modal.innerHTML = `
                <div class="modal fade" id="myModal${patient["Patient ID"]}">
                    <div class="modal-dialog modal-xl modal-dialog-scrollable">
                        <div class="modal-content">

                            <!-- Modal body -->
                            <div class="modal-body ms-3" style="font-family:'Roboto', sans-serif;">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <img src="../../assets/images/medflow-logo.png" width="200" height="100" alt="MedFlow-logo">
                                </div>

                                <h4 class="modal-title mt-3 mb-2"><b>Edit Patient Information</b></h4>
                                <div id="alert-container"></div>
                                <form method="POST" id='myForm' action="#">
                                    <div class="row mt-4">
                                        <div class="col">
                                            <label for="fname" class="form-label"><b>First Name*</b></label>
                                            <input type="text" id="fname" class="form-control" placeholder="Enter first name" name="fname" value="${patient["fname"]}" required>
                                        </div>
                                        <div class="col">
                                            <label for="mname" class="form-label"><b>Middle Name</b></label>
                                            <input type="text" id="mname" class="form-control" placeholder="Enter middle name" name="mname" value="${patient["mname"]}">
                                        </div>
                                        <div class="col">
                                            <label for="lname" class="form-label"><b>Last Name*</b></label>
                                            <input type="text" id="lname" class="form-control" placeholder="Enter last name" name="lname" value="${patient["lname"]}" required>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col">
                                            <label for="dob" class="form-label"><b>Date of Birth*</b></label>
                                            <input type="date" id="dob" class="form-control" placeholder="mm/dd/yyyy" name="dob" value="${patient["dob"]}" required>
                                        </div>
                                        <div class="col">
                                            <label for="gender" class="form-label"><b>Gender*</b></label>
                                            <select id="gender" class="form-select">
                                                <option value="M" <?php echo ${patient["Gender"]} === 'M' ? 'selected' : ''; ?> >Male</option>
                                                <option value="F" <?php echo ${patient["Gender"]} === 'F' ? 'selected' : ''; ?>>Female</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="marital" class="form-label"><b>Marital Status*</b></label>
                                            <select id="marital" class="form-select">
                                                <option value="Single" <?php echo ${patient["marital_status"]} === 'Single' ? 'selected' : ''; ?>>Single</option>
                                                <option value="Married" <?php echo ${patient["marital_status"]} === 'Married' ? 'selected' : ''; ?>>Married</option>
                                                <option value="Widowed" <?php echo ${patient["marital_status"]} === 'Widowed' ? 'selected' : ''; ?>>Widowed</option>
                                                <option value="Divorced" <?php echo ${patient["marital_status"]} === 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col">
                                            <label for="bgroup" class="form-label"><b>Blood Group*</b></label>
                                            <select id="bgroup" class="form-select">
                                                <option value="O" <?php echo ${patient["blood_group"]} === 'O' ? 'selected' : ''; ?>>O</option>
                                                <option value="A" <?php echo ${patient["blood_group"]} === 'A' ? 'selected' : ''; ?>>A</option>
                                                <option value="B" <?php echo ${patient["blood_group"]} === 'B' ? 'selected' : ''; ?>>B</option>
                                                <option value="AB" <?php echo ${patient["blood_group"]} === 'AB' ? 'selected' : ''; ?>>AB</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="email" class="form-label"><b>Email*</b></label>
                                            <input type="email" id="email" class="form-control" placeholder="Enter email address" name="email" value="${patient["email"]}" required>
                                        </div>
                                        <div class="col">
                                            <label for="phone" class="form-label"><b>Phone Number*</b></label>
                                            <input type="tel" id="phone" class="form-control" placeholder="Enter phone number. E.g +123456789" name="phone" value="${patient["phone"]}" required>
                                        </div>
                                    </div>

                                    <label for="address" class="form-label mt-4"><b>Address*</b></label>
                                    <textarea class="form-control" id="address" rows="5" maxlength="500" placeholder="Enter your address" value = ${patient["address"]} required></textarea>

                                    <label for="medications" class="form-label mt-4"><b>Current Medications*</b></label>
                                    <textarea class="form-control" id="medications" rows="5" maxlength="500" placeholder="List your medications" required></textarea>

                                    <div class="row mt-4">
                                        <div class="col">
                                            <label for="status" class="form-label"><b>Status*</b></label>
                                            <select id="bgroup" class="form-select">
                                                <option value="Discharged" <?php echo ${patient["status"]} === 'Discharged' ? 'selected' : ''; ?>>Discharged</option>
                                                <option value="Outpatient" <?php echo ${patient["status"]} === 'Outpatient' ? 'selected' : ''; ?>>Outpatient</option>
                                                <option value="Inpatient" <?php echo ${patient["status"]} === 'Inpatient' ? 'selected' : ''; ?>>Inpatient</option>
                                            </select>
                                        </div>
                                        <div class="col">
                                        </div>
                                        <div class="col">
                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- Modal footer -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-custom" id="edit">Save Changes</button>
                            </div>

                        </div>
                    </div>
                </div>
            `; 
            modals.appendChild(modal);

        });
    } else {
        // Handle case where no patients are available
        alert(data.message || "No patients data available.");
    }
})
.catch(error => console.error('Error fetching patient data:', error));