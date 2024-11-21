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
</body>
</html>






