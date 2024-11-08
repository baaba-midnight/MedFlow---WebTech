<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MedFlow - Appointment Tracker</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
</head>
<body>
    <?php include "../../templates/doctor-sidebar.php"; ?>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Page Header -->
        <div class="dashboard-header">
            <h4 class="mb-0">Appointment Tracker</h4>
            <div class="ms-auto d-flex align-items-center gap-3">
                <!-- Filter and Add Appointment Buttons -->
                <div class="input-group" style="width: 300px;">
                    <input type="text" class="form-control" placeholder="Search appointments...">
                    <button class="btn btn-dark" type="button">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                <button class="btn btn-dark">
                    <i class="fas fa-plus"></i> New Appointment
                </button>
            </div>
        </div>

        <!-- Appointment List Card -->
        <div class="chart-card">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Time <i class="fas fa-sort"></i></th>
                            <th>Patient Name <i class="fas fa-sort"></i></th>
                            <th>Patient ID</th>
                            <th>Type <i class="fas fa-sort"></i></th>
                            <th>Contact</th>
                            <th>Room</th>
                            <th>Duration</th>
                            <th>Status <i class="fas fa-sort"></i></th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $appointments = [
                            [
                                'time' => '09:00 AM',
                                'name' => 'John Doe',
                                'id' => 'P001',
                                'type' => 'Follow-up',
                                'contact' => '+233 50 123 4567',
                                'room' => 'Room 102',
                                'duration' => '30 mins',
                                'status' => 'Checked In'
                            ],
                            [
                                'time' => '10:30 AM',
                                'name' => 'Jane Smith',
                                'id' => 'P002',
                                'type' => 'New Patient',
                                'contact' => '+233 50 987 6543',
                                'room' => 'Room 105',
                                'duration' => '45 mins',
                                'status' => 'Waiting'
                            ],
                            [
                                'time' => '11:45 AM',
                                'name' => 'Kwame Mensah',
                                'id' => 'P003',
                                'type' => 'Consultation',
                                'contact' => '+233 24 555 7890',
                                'room' => 'Room 103',
                                'duration' => '30 mins',
                                'status' => 'Scheduled'
                            ]
                        ];

                        foreach($appointments as $appointment):
                        $statusClass = match($appointment['status']) {
                            'Checked In' => 'bg-success',
                            'Waiting' => 'bg-warning',
                            'Scheduled' => 'bg-info',
                            default => 'bg-secondary'
                        };
                        ?>
                        <tr>
                            <td><?php echo $appointment['time']; ?></td>
                            <td><?php echo $appointment['name']; ?></td>
                            <td><?php echo $appointment['id']; ?></td>
                            <td><?php echo $appointment['type']; ?></td>
                            <td><?php echo $appointment['contact']; ?></td>
                            <td><?php echo $appointment['room']; ?></td>
                            <td><?php echo $appointment['duration']; ?></td>
                            <td>
                                <span class="badge <?php echo $statusClass; ?>">
                                    <?php echo $appointment['status']; ?>
                                </span>
                            </td>
                            <td>
                                <div class="d-flex gap-1">
                                    <button class="btn btn-sm btn-primary" title="Start Session">
                                        <i class="fas fa-play"></i>
                                    </button>
                                    <button class="btn btn-sm btn-warning" title="Reschedule">
                                        <i class="fas fa-calendar-alt"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" title="Cancel">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <!-- Daily Summary -->
            <div class="mt-4 p-3 bg-light rounded">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-users me-2 text-primary"></i>
                            <div>
                                <small class="text-muted">Total Appointments</small>
                                <h5 class="mb-0">8</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-clock me-2 text-warning"></i>
                            <div>
                                <small class="text-muted">Waiting</small>
                                <h5 class="mb-0">2</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-check-circle me-2 text-success"></i>
                            <div>
                                <small class="text-muted">Completed</small>
                                <h5 class="mb-0">3</h5>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="d-flex align-items-center">
                            <i class="fas fa-calendar-alt me-2 text-info"></i>
                            <div>
                                <small class="text-muted">Upcoming</small>
                                <h5 class="mb-0">3</h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>