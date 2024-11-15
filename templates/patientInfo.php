
<div class="modal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-body p-4">
                <!-- Header -->
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="mb-0">Patient Information</h2>
                    <span class="status-badge">Inpatient</span>
                </div>

                <!-- Basic Information -->
                <div class="card">
                    <h4 class="mb-4">Basic Information</h4>
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="info-label">Patient ID</div>
                                    <div class="info-value">P001</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Full Name</div>
                                    <div class="info-value">John Doe</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Age</div>
                                    <div class="info-value">45 years</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Gender</div>
                                    <div class="info-value">Male</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Department</div>
                                    <div class="info-value">Cardiology</div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="info-label">Admission Date</div>
                                    <div class="info-value">2023-10-15</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4 text-center">
                            <img src="./assets/images/man-1.jpg" alt="Patient" class="profile-img">
                        </div>
                    </div>
                </div>

                <!-- Contact Information -->
                <div class="card">
                    <h4 class="sm-4">Contact Information</h4>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="info-label">Phone</div>
                            <div class="info-value">+1 (555) 123-4567</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-label">Emergency Phone</div>
                            <div class="info-value">+1 (555) 123-4567</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-label">Email</div>
                            <div class="info-value">john.doe@gmail.com</div>
                        </div>
                        <div class="col-sm-6">
                            <div class="info-label">Address</div>
                            <div class="info-value">123 Medical Centre Drive, Healthcare City, HC 12345</div>
                        </div>
                    </div>
                </div>

                <!-- Medical Information -->
                <div class="card">
                    <h4 class="sm-4">Medical Information</h4>
                    <ul class="nav nav-tabs">
                        <li class="nav-item">
                            <a class="nav-link active" href="#vitals">Vitals</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#diagnosis">Diagnosis</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#medications">Medications</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#allergies">Allergies</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#lab-results">Lab Results</a>
                        </li>
                    </ul>

                    <div class="tab-content">
                        <!-- Vitals Tab Content -->
                        <div class="tab-pane active" id="vitals">
                            <div class="row g-4">
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">Blood Pressure</div>
                                        <div class="vitals-value">140/90 mmHg</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">Heart Rate</div>
                                        <div class="vitals-value">78 bpm</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">Temperature</div>
                                        <div class="vitals-value">37.5 °C</div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="vitals-card">
                                        <div class="info-label">SpO2</div>
                                        <div class="vitals-value">98%</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Diagnosis Tab Content -->
                        <div class="tab-pane fade" id="diagnosis">
                            <p class="text-muted">No current diagnosis</p>
                        </div>

                        <!-- Medications Tab Content -->
                        <div class="tab-pane fade" id="medications">
                            <p class="text-muted">No current medications</p>
                        </div>

                        <!-- Allergies Tab Content -->
                        <div class="tab-pane fade" id="allergies" role="tabpanel">
                            <p class="text-muted">No known allergies</p>
                        </div>

                        <!-- Lab Results Tab Content-->
                        <div class="tab-pane fade" id="lab-results" role="tabpanel">
                            <p class="text-muted">No recent lab results</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>