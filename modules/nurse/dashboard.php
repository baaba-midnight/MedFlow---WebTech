<?php
// The code to connect to the database
include "../../includes/config.inc.php";

//The code to enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);





//The code for the query to get total users, recipes, and active users
$totalPatientsQuery = "SELECT COUNT(*) FROM Patients";
$totalPatientsResult = $conn->query($totalPatientsQuery);
$totalPatients = $totalPatientsResult->fetch_row()[0];

// Query to count the total number of inpatients
$totalInpatientsQuery = "SELECT COUNT(*) FROM Patients WHERE status = 'inpatient'";
$totalInpatientsResult = $conn->query($totalInpatientsQuery);
$totalInpatients = $totalInpatientsResult->fetch_row()[0];

// Query to count the total number of outpatients
$totalOutpatientsQuery = "SELECT COUNT(*) FROM Patients WHERE status = 'outpatient'";
$totalOutpatientsResult = $conn->query($totalOutpatientsQuery);
$totalOutpatients = $totalOutpatientsResult->fetch_row()[0];

// Query to count the total number of outpatients
$totalActiveQuery = "SELECT COUNT(*) FROM MedicalHistory WHERE case_condition= 'active'";
$totalActiveResult = $conn->query($totalActiveQuery);
$totalActive = $totalActiveResult->fetch_row()[0];

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
    <?php include "../../templates/nurse-sidebar.php"; ?>

    <!-- Main Content -->
<div class="main-content">
    <div class="dashboard-header">
        <h4 class="mb-0">Nurse Dashboard</h4>
    </div>

    <div class="row">
        <!-- Main Content Column -->
        <div class="col-md-12">
            <!-- Stats Cards -->
            <div class="row g-4 mb-4">
                <div class="col-md-6">
                    <div class="stat-card primary">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Total Patients</div>
                                <h2><?php echo $totalPatients; ?></h2>
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
                                <div>Total Inpatients</div>
                                <h2 ><?php echo $totalInpatients; ?></h2>
                                <small id="pending-tasks-date"></small>
                            </div>
                            <button class="see-details align-self-start" onclick="openModal('patients')">See Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card dark">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Total Outpatients</div>
                                <h2 ><?php echo $totalOutpatients; ?></h2>
                                <small id="critical-patients-change"></small>
                            </div>
                            <button class="see-details align-self-start" onclick="openModal('patients ')">See Details</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="stat-card teal">
                        <div class="d-flex justify-content-between">
                            <div>
                                <div>Patients with Active cases</div>
                                <h2><?php echo $totalActive; ?></h2>
                                <small id="consultations-change"></small>
                            </div>
                            <button class="see-details align-self-start" onclick="openModal('medicalHistory')">See Details</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal See Details -->
    <?php include '../../templates/doctorDashboardModal.php' ?>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script src="../../assets/js/doctor-dashboard.js"></script>
    <script src="../../assets/js/doctor-dashboardModal.js"></script>
</body>
</html>


