<!-- Form Modal to ADD patient data -->
<div class="modal fade" id="addPatientModal">
    <div class="modal-dialog modal-xl modal-dialog-scrollable">
        <div class="modal-content">
    
            <!-- Modal body -->
            <div class="modal-body ms-3"  style="font-family:'Roboto', sans-serif;">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <img src="../../assets/images/medflow-logo.png" widtth="200" height="100" alt="MedFlow-logo">
                </div>
                
                <h4 class="modal-title mt-3 mb-2"><b>Add New Patient</b></h4>
                <div id="alert-container"></div>
                <form method="POST" id="addPatientModal" action="../functions/add_patient.inc.php">
                    <div class="row mt-4">
                        <div class="col">
                        <label for="fname" class="form-label"><b>First Name*</b></label>
                        <input type="text" id="fname" class="form-control" placeholder="Enter first name" name="fname" required>
                        </div>
                        <div class="col">
                        <label for="mname" class="form-label"><b>Middle Name</b></label>
                        <input type="text" id="mname" class="form-control" placeholder="Enter middle name" name="mname">
                        </div>
                        <div class="col">
                        <label for="lname" class="form-label"><b>Last Name*</b></label>
                        <input type="text" id="lname" class="form-control" placeholder="Enter last name" name="lname" required>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <label for="dob" class="form-label"><b>Date of Birth*</b></label>
                            <input type="date" id="dob" class="form-control" placeholder="mm/dd/yyyy" name="dob" required>
                        </div>
                        <div class="col">
                            <label for="gender" class="form-label"><b>Gender*</b></label>
                            <select id="gender" class="form-select">
                                <option value="M">Male</option>
                                <option value="F">Female</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="marital" class="form-label"><b>Marital Status*</b></label>
                            <select id="marital" class="form-select">
                                <option value="Single">Single</option>
                                <option value="Married">Married</option>
                                <option value="Widowed">Widowed</option>
                                <option value="Divorced">Divorced</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col">
                            <label for="bgroup" class="form-label"><b>Blood Group*</b></label>
                            <select id="bgroup" class="form-select">
                                <option value="O">O</option>
                                <option value="A">A</option>
                                <option value="B">B</option>
                                <option value="AB">AB</option>
                            </select>
                        </div>
                        <div class="col">
                            <label for="email" class="form-label"><b>Email*</b></label>
                            <input type="email" id="email" class="form-control" placeholder="Enter email address" name="email" required>
                        </div>
                        <div class="col">
                            <label for="phone" class="form-label"><b>Phone Number*</b></label>
                            <input type="tel" id="phone" class="form-control" placeholder="Enter phone number. E.g +123456789" name="phone" required>
                        </div>
                    </div>

                    <label for="address" class="form-label mt-4"><b>Address*</b></label>
                    <textarea class="form-control" id="address" rows="5" maxlength="500" placeholder="Enter your address" required></textarea>

                    <label for="medications" class="form-label mt-4"><b>Current Medications*</b></label>
                    <textarea class="form-control" id="medications" rows="5" maxlength="500" placeholder="List your medications" required></textarea>

                </form>
            </div>
        
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancel</button>
                <button class="btn btn-custom" id="edit">Save</button>
            </div>
        </div>
    </div>
</div>