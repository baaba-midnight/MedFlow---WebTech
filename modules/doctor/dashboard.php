<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    die("Not logged in");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Doctor Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    
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
                                <h2 id="assigned-patients-count" class="count">0</h2>
                                <small id="assigned-patients-change"></small>
                            </div>
                            <button class="see-details align-self-start" id="assigned-patients" onclick="openModal('patients')">See Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card dark">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Pending Tasks</div>
                                <h2 id="pending-tasks-count" class="count">0</h2>
                                <small id="pending-tasks-date"></small>
                            </div>
                            <button class="see-details align-self-start" onclick="openModal('tasks')">See Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card dark">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Critical Patients</div>
                                <h2 id="critical-patients-count" class="count">0</h2>
                                <small id="critical-patients-change"></small>
                            </div>
                            <button class="see-details align-self-start" onclick="openModal('critical')">See Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card teal">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>New Consultations</div>
                                <h2 id="new-consultations-count" class="count">0</h2>
                                <small id="consultations-change"></small>
                            </div>
                            <button class="see-details align-self-start" onclick="openModal('consultations')">See Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Current Patients -->
        <div class="col-md-4">
            <div class="current-patients">
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
    </div>

    <!-- Modal See Details -->
    <?php include '../../templates/doctorDashboardModal.php' ?>
</div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../../assets/js/doctor-dashboard.js"></script>
    <script src="../../assets/js/doctor-dashboardModal.js"></script>
    <!-- <script src="../../assets/js/admin-modal.js"></script> -->
</body>
</html>