<!-- Sidebar -->
<div class="sidebar">
    <div class="logo-section">
        <img src="../../assets/images/medflow_mini_logo.png" alt="MedFlow">
        <h1>MedFlow</h1>
    </div>
    
    <nav class="nav flex-column mt-4">
        <a class="nav-link" href="dashboard.php"><i class="fas fa-home me-2"></i> Dashboard</a>
        <a class="nav-link" href="patient_records.php"><i class="fas fa-user-injured me-2"></i> Patient Management</a>
        <!-- <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar me-2"></i> Billing</a> -->
        <!-- <a class="nav-link" href="appointments.php"><i class="fas fa-file-medical me-2"></i> Appointment Tracker</a> -->
    </nav>

    <div class="user-profile">
        <div class="profile-image">
            <img src="../../assets/images/man-1.jpg" alt="Profile" class="me-3">
        </div>
        <div class="profile-details">
            <h6>Michael Jerome</h6>
            <p>Admin</p>
            <a href="mailto:michael.jerome@medflow.com">michael.jerome@medflow.com</a>
        </div>
    </div>
</div>

<script>
    // Get the current page url
    const currentPage = window.location.pathname.split("/").pop();
    console.log(currentPage);

    // Get all sidebar links
    const sidebarLinks = document.querySelectorAll(".nav-link");


    // add the active class to the current page link
    sidebarLinks.forEach(link => {
        console.log(link.getAttribute('href'))
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    })
</script>