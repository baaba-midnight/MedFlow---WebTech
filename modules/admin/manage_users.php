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
            $headerTitle = 'Manage Users';
            $buttonContent = 'Add User';
            include '../../templates/header.php'; 
        ?>

        <div class="table-container">
            <table class="table" id="userTable">
                <thead>
                    <tr>
                        <th>Staff ID</th>
                        <th>Staff Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Department</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                
                <tbody>
                    <!-- Insert data with JS -->
                </tbody>
            </table>
        </div>

        <!-- Add New User -->
        <button type="button" class="action-btn add-patient" onclick="">
          <span class="action-icon"></span> Add Patient
        </button>
    </div>

    <script src="../../assets/js/fetch_users.js"></script>
</body>
</html>