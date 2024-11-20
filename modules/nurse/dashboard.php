<?php
// The code to connect to the database
include "../includes/config.inc.php";

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
$totalActiveQuery = "SELECT COUNT(*) FROM MedicalHistory WHERE status = 'active'";
$totalActiveResult = $conn->query($totalActiveQuery);
$totalActive = $totalActiveResult->fetch_row()[0];

?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Nurse Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/nurse_dashboard.css">
    <link rel="stylesheet" href="../../assets/css/modal.css">
</head>
<body>
    <?php include "../../templates/nurse-sidebar.php"; ?>

    <!-- Main Content -->
    <div class="main-content">
        <div class="dashboard-header">
            <div class="header-left d-flex align-items-center">
                <h4 class="dashboard-title mb-0 me-3">Nurse Dashboard</h4>
                
            </div>
            
        </div>

        <!-- Row for Cards -->
        <div class="row row-cols-1 row-cols-md-2 g-4">
            <!-- Card 1 -->
            <div class="col">
                <div class="stat-card primary">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Total Patients</div>
                            <h2><?php echo $totalPatients; ?></h2>
                            <small>Number of Patients</small>
                        </div>
                        <button class="see-details align-self-start">See Details</button>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="col">
                <div class="stat-card dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Total Inpatients</div>
                            <h2><?php echo $totalInpatients; ?></h2>
                            <small>urgent reviews needed</small>
                        </div>
                        <button class="see-details align-self-start">See Details</button>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="col">
                <div class="stat-card dark">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Total outpatients</div>
                            <h2><?php echo $totalOutpatients; ?></h2>
                            <small>needs critical attention</small>
                        </div>
                        <button class="see-details align-self-start">See Details</button>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="col">
                <div class="stat-card teal">
                    <div class="d-flex justify-content-between">
                        <div>
                            <div>Total active cases</div>
                            <h2><?php echo $totalActive; ?></h2>
                            <small>Patients with active cases</small>
                        </div>
                        <button class="see-details align-self-start">See Details</button>
                    </div>
                </div>
            </div>
        </div> <!-- End Row for Cards -->
        
    </div> <!-- End Main Content -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>


