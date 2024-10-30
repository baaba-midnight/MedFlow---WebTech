<!DOCTYPE html>
<html lang="en">
<!-- Head section -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Doctor Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="logo-section">
            <img src="path-to-logo.png" alt="MedFlow">
        </div>
        
        <nav class="nav flex-column mt-4">
            <a class="nav-link active" href="#"><i class="fas fa-home me-2"></i> Dashboard</a>
            <a class="nav-link" href="#"><i class="fas fa-user-injured me-2"></i> My Patients</a>
            <a class="nav-link" href="#"><i class="fas fa-calendar-alt me-2"></i> Appointments</a>
            <a class="nav-link" href="#"><i class="fas fa-notes-medical me-2"></i> Medical Records</a>
            <a class="nav-link" href="#"><i class="fas fa-prescription me-2"></i> Prescriptions</a>
            <a class="nav-link" href="#"><i class="fas fa-comments me-2"></i> Messages</a>
        </nav>

        <div class="user-profile">
            <div class="d-flex align-items-center">
                <img src="../../assets/images/man-1.jpg" alt="Profile" class="me-3">
                <div>
                    <h6 class="mb-1">Dr. Michael Jerome</h6>
                    <small>Cardiologist</small>
                    <div class="small mt-1">michael.jerome@medflow.com</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h4 class="mb-0">Doctor Dashboard</h4>
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search patients...">
            </div>
        </div>

        <!-- Today's Overview -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="stat-card primary">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Today's Appointments</div>
                            <h2>8</h2>
                            <small>Next appointment in 30 mins</small>
                        </div>
                        <a href="#" class="see-details align-self-start">View Schedule</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Pending Reports</div>
                            <h2>5</h2>
                            <small>3 urgent reviews needed</small>
                        </div>
                        <a href="#" class="see-details align-self-start">Review Now</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Critical Patients</div>
                            <h2>3</h2>
                            <small>1 needs immediate attention</small>
                        </div>
                        <a href="#" class="see-details align-self-start">Check Status</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="stat-card teal">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>New Messages</div>
                            <h2>12</h2>
                            <small>4 urgent consultations</small>
                        </div>
                        <a href="#" class="see-details align-self-start">Read Messages</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Patient Management Section -->
        <div class="row mt-4">
            <div class="col-md-8">
                <div class="chart-card">
                    <h6 class="mb-4">Today's Schedule</h6>
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
                                    <td>John Smith</td>
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
            <div class="col-md-4">
                <div class="chart-card">
                    <h6 class="mb-4">Patient Statistics</h6>
                    <div class="mb-4">
                        <h5>Patient Categories</h5>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-primary" style="width: 40%">Follow-up (40%)</div>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-success" style="width: 30%">New Patients (30%)</div>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar bg-warning" style="width: 20%">Chronic Care (20%)</div>
                        </div>
                        <div class="progress">
                            <div class="progress-bar bg-danger" style="width: 10%">Emergency (10%)</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>
</html>