<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Patient Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <?php include "../../templates/doctor-sidebar.php"; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="dashboard-header">
            <h4 class="mb-0">Patient Management</h4>
            <div class="ms-auto d-flex align-items-center gap-3">
                <!-- Filter and Add Patient Buttons -->
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search patients...">
                    <button class="btn btn-dark" type="button">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                <button class="btn btn-dark">
                    <i class="fas fa-plus"></i> Add Patient
                </button>
            </div>
        </div>

        <!-- Patient List Card -->
        <div class="chart-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>
                                <input type="checkbox" class="form-check-input">
                            </th>
                            <th>Patient ID <i class="fas fa-sort"></i></th>
                            <th>Patient Name <i class="fas fa-sort"></i></th>
                            <th>Age <i class="fas fa-sort"></i></th>
                            <th>Gender <i class="fas fa-sort"></i></th>
                            <th>Admission Date <i class="fas fa-sort"></i></th>
                            <th>Primary Diagnosis</th>
                            <th>Status <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php for($i = 1; $i <= 7; $i++): ?>
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input">
                            </td>
                            <td>P001</td>
                            <td>John Doe</td>
                            <td>45</td>
                            <td>Male</td>
                            <td>2023-10-15</td>
                            <td>Hypertension</td>
                            <td>
                                <span class="badge <?php echo $i % 2 == 0 ? 'bg-danger' : 'bg-success' ?>">
                                    <?php echo $i % 2 == 0 ? 'OUTPATIENT' : 'INPATIENT' ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-primary">View</button>
                                    <button class="btn btn-sm btn-warning">Edit</button>
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </div>
                            </td>
                        </tr>
                        <?php endfor; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>