<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- For icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href="../../assets/css/admin-tables.css">
</head>
<body>
    <?php include '../../templates/admin-sidebar.php'; ?>
    <div class="main-content">
        <?php 
            $headerTitle = 'Manage Patients';
            include '../../templates/header.php'; 
        ?>

        <div class="table-container">
            <table class="table" id="patientTable">
                <thead>
                    <tr>
                        <th>Patient ID</th>
                        <th>Patient Name</th>
                        <th>Age</th>
                        <th>Admission Date</th>
                        <th>Department</th>
                        <th>Primary Diagnosis</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td>1</td>
                        <td>Baaba Amosah</td>
                        <td>0</td>
                        <td>30-09-2004</td>
                        <td>Pediatrics</td>
                        <td>Frustration</td>
                        <td>
                            <div class="status outpatient">Outpatient</div>
                        </td>
                        <td>
                            <div class="selected-actions" id="selectedActions">
                                <button class="action-btn edit-btn" onclick="">
                                    <span class="action-icon">✏️</span> Edit
                                </button>
                                <button class="action-btn remove-btn">
                                    <span class="action-icon">🗑️</span> Remove
                                </button>
                                <button class="action-btn open-btn" onclick="">
                                    <span class="action-icon">📂</span> Open
                                </button>
                            </div>
                        </td> 
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr>
                        <td>2</td>
                        <td>Baaba Amosah</td>
                        <td>0</td>
                        <td>30-09-2004</td>
                        <td>Pediatrics</td>
                        <td>Frustration</td>
                        <td>
                            <div class="status inpatient">Inpatient</div>
                        </td>
                        <td>
                            <div class="selected-actions" id="selectedActions">
                                <button class="action-btn edit-btn" onclick="">
                                    <span class="action-icon">✏️</span> Edit
                                </button>
                                <button class="action-btn remove-btn">
                                    <span class="action-icon">🗑️</span> Remove
                                </button>
                                <button class="action-btn open-btn" onclick="">
                                    <span class="action-icon">📂</span> Open
                                </button>
                            </div>
                        </td> 
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>