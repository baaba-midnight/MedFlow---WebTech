<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- For icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Custom Dashboard Stylesheet -->
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <?php include "./templates/sidebar.php"; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <h4 class="mb-0">Dashboard</h4>
            <div class="search-box">
                <input type="text" class="form-control" placeholder="Search...">
            </div>
        </div>

        <!-- Stats Row -->
        <div class="row">
            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card primary">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Active Patients</div>
                                <h2>2,234</h2>
                                <small>+20 more patients than last month</small>
                            </div>
                            <a href="#" class="see-details align-self-start">See Details</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="stat-card dark">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Critical Patients</div>
                                <h2>100</h2>
                                <small>+10 more patients than last month</small>
                            </div>
                            <a href="#" class="see-details align-self-start">See Details</a>
                        </div>
                    </div>
                </div>

                <div class='col-md-4'>
                <div class="bed-occupancy">
                    <h6 class="mb-3">Bed Occupancy</h6>
                    <h3 class="mb-3">76%</h3>
                    <div class="progress">
                        <div class="progress-bar bg-primary" role="progressbar" style="width: 76%"></div>
                    </div>
                    <small class="text-muted d-block mt-2">Updated: Just Now</small>
                </div>
            </div>
            </div>

            <div class="row">
                <div class="col-md-4">
                    <div class="stat-card dark">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Appointments</div>
                                <h2>50</h2>
                                <small>18th October 2024</small>
                            </div>
                            <a href="#" class="see-details align-self-start">See Details</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="stat-card" style="background-color: #2F4F4F">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Staff</div>
                                <h2>150</h2>
                                <small>+20 more than last month</small>
                            </div>
                            <a href="#" class="see-details align-self-start">See Details</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Charts Row -->
        <div class="row">
            <div class="col-md-8">
                <div class="chart-card">
                    <h6 class="mb-4">Patient Status</h6>
                    <canvas id="patient-status" width="auto" height="300px" border-radius=8px></canvas>
                </div>
            </div>
            <div class="col-md-4">
                <div class="chart-card">
                    <h6 class="mb-4">Staff Distribution</h6>
                    <canvas id="staff-distribution" width="auto" height="100px" border-radius=8px></canvas>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="../../assets/js/admin-chart.js"></script>
</body>
</html>