<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Nurse Dashboard</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
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
                <div class="search-box">
                    <input type="text" class="form-control" placeholder="Search...">
                </div>
            </div>
            <div class="header-right d-flex align-items-center">
                <i class="far fa-clock me-2 icon-blue"></i>
                <span class="date-text me-3">Thursday, October 24, 2024</span>
                <i class="fas fa-bell icon-blue"></i>
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
                                    <div>Today's Medication</div>
                                    <h2>24</h2>
                                    <small>Medication for patient</small>
                                </div>
                                <button class="see-details align-self-start">See Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card dark">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Pending Reports</div>
                                    <h2>5</h2>
                                    <small>urgent reviews needed</small>
                                </div>
                                <button class="see-details align-self-start">See Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card dark">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>Critical Patients</div>
                                    <h2>3</h2>
                                    <small>needs critical attention</small>
                                </div>
                                <button class="see-details align-self-start">See Details</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="stat-card teal">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>New Messages</div>
                                    <h2>8</h2>
                                    <small>urgent requests</small>
                                </div>
                                <button class="see-details align-self-start">See Details</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Appointments Section -->
                <div class="appointments-section">
                    <div class="chart-card">
                        <h5 class="mb-4"><i class="fas fa-calendar-alt me-2 icon-blue"></i>Today's Appointments</h5>
                        <div class="appointment-card">
                            <div class="appointment-details">
                                <strong>Akua Botwe</strong>
                                <p>09:00 AM - ROOM 102</p>
                            </div>
                            <button class="btn btn-sm btn-outline">Follow-up</button>
                        </div>
                        <div class="appointment-card">
                            <div class="appointment-details">
                                <strong>Jane Smith</strong>
                                <p>10:30 AM - ROOM 105</p>
                            </div>
                            <button class="btn btn-sm btn-outline">New Consultation</button>
                        </div>
                        <div class="appointment-card">
                            <div class="appointment-details">
                                <strong>Kweku Amoah</strong>
                                <p>02:00 PM - Surgery 2</p>
                            </div>
                            <button class="btn btn-sm btn-outline">Procedure</button>
                        </div>
                    </div>
                </div>


            </div>

            <!-- Right Side Column -->
            <div class="table-container">
                <table class="table" id="patientTable">
                    <thead>
                        <tr>
                            
                            <th>Patient Name</th>
                            <th>Age/Gender</th>
                            
                            
                            <th>Diagnosis</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                
                    <tbody>
                        <!-- Row 1 -->
                        <tr>
                            
                            <td>Baaba Amosah</td>
                            <td>21/F</td>
                            
                            
                            <td>Frustration</td>
                            <td>
                                <div class="outpatient">Outpatient</div>
                            </td>
                            <td>
                                
                                <div class="action-icons">
                                    <a href="#" class="edit-icon" title="Edit">
                                        ✏️
                                    </a>
                                    <a href="#" class="remove-icon" title="Remove">
                                        🗑️
                                    </a>
                                    <a href="#" class="open-icon" title="Open">
                                        📂
                                    </a>
                                </div>
                            </td>
                        </tr>
                    
                    <!-- Row 2 -->
                        <tr>
                            
                            <td>Kelvin Cudjoe</td>
                            <td>30/M</td>
                            
                            
                            <td>Headache</td>
                            <td>
                                <div class="inpatient">Inpatient</div>
                            </td>
                            <td>
                                <div class="action-icons">
                                    <a href="#" class="edit-icon" title="Edit">
                                        ✏️
                                    </a>
                                    <a href="#" class="remove-icon" title="Remove">
                                        🗑️
                                    </a>
                                    <a href="#" class="open-icon" title="Open">
                                        📂
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>