<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Doctor Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/modal.css">
</head>
<body>
    <?php include "../../templates/doctor-sidebar.php"; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h4 class="mb-0">Dashboard</h4>
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
        </div>

        <div class="row">
            <!-- Main Content Column -->
            <div class="col-md-8">
                <!-- Stats Cards -->
                <div class="row g-4 mb-4">
                    <div class="col-md-6">
                        <div class="stat-card primary">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Assigned Patients</div>
                                    <h2>24</h2>
                                    <small>+20 more patients than last month</small>
                                </div>
                                <button class="see-details align-self-start" id="active-patients">See Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card dark">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Pending Tasks</div>
                                    <h2>5</h2>
                                    <small>18th October 2024</small>
                                </div>
                                <button class="see-details align-self-start" id="active-patients">See Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card dark">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Critical Patients</div>
                                    <h2>3</h2>
                                    <small>+20 more patients than last month</small>
                                </div>
                                <button class="see-details align-self-start" id="active-patients">See Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card teal">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>New Consultation</div>
                                    <h2>8</h2>
                                    <small>+20 more patients than last month</small>
                                </div>
                                <button class="see-details align-self-start" id="active-patients">See Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointments Section -->
                <div class="chart-card">
                    <h5 class="mb-4">Today's Appointments</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Time</th>
                                    <th>Patient</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>09:00 AM</td>
                                    <td>John Doe</td>
                                    <td>Follow-up</td>
                                    <td><span class="badge bg-success">Checked In</span></td>
                                    <td><button class="btn btn-sm btn-primary">Start Session</button></td>
                                </tr>
                                <tr>
                                    <td>10:30 AM</td>
                                    <td>Sarah Johnson</td>
                                    <td>New Patient</td>
                                    <td><span class="badge bg-warning">Waiting</span></td>
                                    <td><button class="btn btn-sm btn-secondary">View Details</button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Side Column -->
            <div class="col-md-4">
                <div class="bed-occupancy">
                    <h5 class="mb-4">Current Patients</h5>
                    <div class="patient-list">
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1">John Doe</h6>
                                    <small class="text-muted">ID: P001</small>
                                </div>
                                <div class="action-icons">
                                    <a href="#"><i class="fas fa-clipboard"></i></a>
                                    <a href="#"><i class="fas fa-edit"></i></a>
                                    <a href="#"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small>45/M - Hypertension</small>
                                <span class="badge bg-success">Outpatient</span>
                            </div>
                        </div>
                        <div class="mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div>
                                    <h6 class="mb-1">Jane Smith</h6>
                                    <small class="text-muted">ID: P002</small>
                                </div>
                                <div class="action-icons">
                                    <a href="#"><i class="fas fa-clipboard"></i></a>
                                    <a href="#"><i class="fas fa-edit"></i></a>
                                    <a href="#"><i class="fas fa-trash"></i></a>
                                </div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <small>32/F - Diabetes Type 2</small>
                                <span class="badge bg-danger">Inpatient</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <!-- Modal See Details -->
        <div class="modal" id="myModal">
            <!-- Modal Content -->
            <div class="modal-content">
                <span class="close">&times;</span>
                <p>Some text in the Modal..</p>
            </div>
        </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>