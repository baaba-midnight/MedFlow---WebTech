<div class="modal fade" id="displayModal" data-bs-backdrop="true" data-bs-keyboard="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Patient Information</h2>
                    <span class="status-badge" id="statusInfo">Inpatient</span>
                </div>

                <!-- Basic Information -->
                <div class="card">
                    <h4 class="mb-4">Basic Information</h4>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="info-label">Patient ID</div>
                                    <div class="info-value" id="patientID">P001</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Full Name</div>
                                    <div class="info-value" id="patientName">John Doe</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Age</div>
                                    <div class="info-value" id="patientAge">45 years</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Gender</div>
                                    <div class="info-value" id="patientGender">Male</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Department</div>
                                    <div class="info-value" id="patientDepartment">Cardiology</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Admission Date</div>
                                    <div class="info-value" id="patientAdmissionDate">2023-10-15</div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-sm-4 text-center">
                            <img src="../../assets/images/man-1.jpg" alt="Patient" class="profile-img">
                        </div> -->
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <h4 class="sm-4">Contact Information</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="info-label">Phone</div>
                            <div class="info-value" id="patientContact">+1 (555) 123-4567</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-label">Email</div>
                            <div class="info-value" id="patientEmail">john.doe@gmail.com</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-label">Address</div>
                            <div class="info-value" id="patientAddress">123 Medical Centre Drive, Healthcare City, HC 12345</div>
                        </div>
                    </div>
                </div>

                <!-- Medical Information -->
                <div class="card">
                    <h4 class="sm-4">Medical Information</h4>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link medical active" href="#vitals">Vitals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link medical" href="#diagnosis">Diagnosis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link medical" href="#medications">Medications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link medical" href="#allergies">Allergies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link medical" href="#lab-results">Lab Results</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Vitals Tab Content -->
                        <div class="tab-pane active" id="vitals">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">Blood Pressure</div>
                                        <div class="vitals-value" id="blood_pressure">140/90 mmHg</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">Heart Rate</div>
                                        <div class="vitals-value" id="heart_rate">78 bpm</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">Temperature</div>
                                        <div class="vitals-value" id="temperature">37.5 °C</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">SpO2</div>
                                        <div class="vitals-value" id="spo2">98%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Diagnosis Tab Content -->
                        <div class="tab-pane fade" id="diagnosis">
                            <p id="diagnosis-message" class="text-muted">No current diagnosis</p>

                            <table id="diagnosis-table" class="table table-striped" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Diagnosis</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="diagnosis-table-body">
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Medications Tab Content -->
                        <div class="tab-pane fade" id="medications">
                            <p id="medications-message" class="text-muted">No current medications</p>

                            <table id="medications-table" class="table table-striped" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Dosage</th>
                                        <th>Frequency</th>
                                        <th>Prescribed By</th>
                                        <th>Start Date</th>
                                        <th>End Date</th>
                                    </tr>
                                </thead>
                                <tbody id="medications-table-body">
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Allergies Tab Content -->
                        <div class="tab-pane fade" id="allergies" role="tabpanel">
                            <p id="allergies-message" class="text-muted">No known allergies</p>

                            <table id="allergies-table" class="table table-striped" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Allergy</th>
                                        <th>Severity</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="allergies-table-body">
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>

                        <!-- Lab Results Tab Content-->
                        <div class="tab-pane fade" id="lab-results" role="tabpanel">
                            <p id="lab-message" class="text-muted">No recent lab results</p>

                            <table id="lab-table" class="table table-striped" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>Test Type</th>
                                        <th>Date</th>
                                        <th>Result</th>
                                        <th>Normal Range</th>
                                        <th>Performed By</th>
                                        <th>Notes</th>
                                    </tr>
                                </thead>
                                <tbody id="lab-table-body">
                                    <!-- Rows will be dynamically added here -->
                                </tbody>
                            </table>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>