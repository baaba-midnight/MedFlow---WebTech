<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- For icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/admin-tables.css">
    <link rel="stylesheet" href="../../assets/css/edit.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
    <?php include '../../templates/admin-sidebar.php'; ?>
    <div class="main-content">
        <?php 
            $headerTitle = 'Manage Patients';
            include '../../templates/header.php'; 
        ?>

        <div class="table-container">
            <table class="table" id="patientTable">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Admission Date</th>
                        <th>Department</th>
                        <th>Primary Diagnosis</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td>1</td>
                        <td>Baaba Amosah</td>
                        <td>0</td>
                        <td>30-09-2004</td>
                        <td>Pediatrics</td>
                        <td>Frustration</td>
                        <td>
                            <div class="status outpatient">Outpatient</div>
                        </td>
                        <td>
                            <div class="selected-actions" id="selectedActions">
                                <button type="button" class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#myModal" onclick="">
                                    <span class="action-icon">✏️</span> Edit
                                </button>
                                <button class="action-btn remove-btn">
                                    <span class="action-icon">🗑️</span> Remove
                                </button>
                                <button class="action-btn open-btn" onclick="">
                                    <span class="action-icon">📂</span> Open
                                </button>
                                <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Open modal</button> -->
                            </div>
                        </td> 
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr>
                        <td>2</td>
                        <td>Baaba Amosah</td>
                        <td>0</td>
                        <td>30-09-2004</td>
                        <td>Pediatrics</td>
                        <td>Frustration</td>
                        <td>
                            <div class="status inpatient">Inpatient</div>
                        </td>
                        <td>
                            <div class="selected-actions" id="selectedActions">
                                <button class="action-btn edit-btn" onclick="" data-bs-toggle="modal" data-bs-target="#myModal>
                                    <span class="action-icon">✏️</span> Edit
                                </button>
                                <button class="action-btn remove-btn">
                                    <span class="action-icon">🗑️</span> Remove
                                </button>
                                <button class="action-btn open-btn" onclick="">
                                    <span class="action-icon">📂</span> Open
                                </button>
                            </div>
                        </td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
     <!-- The Modal -->
     <div class="modal fade" id="myModal">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
          <div class="modal-content">
      
            <!-- Modal body -->
            <div class="modal-body ms-3"  style="font-family:'Roboto', sans-serif;">
                <div class="d-flex align-items-center justify-content-center mb-2">
                    <img src="../../assets/images/medflow-logo.png" widtth="200" height="100" alt="MedFlow-logo">
                </div>
                
                <h4 class="modal-title mt-3 mb-2"><b>Edit Patient Information</b></h4>
                <div id="alert-container"></div>
                <form method="POST" id='myForm' action = "#">
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
                          <label for="gender" class="form-label"><b>Sex*</b></label>
                          <select id = "gender" class="form-select">
                            <option>Male</option>
                            <option>Female</option>
                          </select>
                        </div>
                        <div class="col">
                          <label for="marital" class="form-label"><b>Marital Status*</b></label>
                          <select id = "marital" class="form-select">
                            <option>Single</option>
                            <option>Married</option>
                            <option>Widowed</option>
                            <option>Divorced</option>
                            <option>Separated</option>
                            <option>Registered Partnership</option>
                          </select>
                        </div>
                      </div>

                      <div class="row mt-4">
                        <div class="col">
                          <label for="bgroup" class="form-label"><b>Blood Group*</b></label>
                          <select id="bgroup" class="form-select">
                            <option>O</option>
                            <option>A</option>
                            <option>B</option>
                            <option>AB</option>
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
              <button class="btn btn-custom" id="edit" >Save Changes</button>
            </div>
      
          </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../../assets/js/edit_patient_modal.js"></script>
</body>
</html>