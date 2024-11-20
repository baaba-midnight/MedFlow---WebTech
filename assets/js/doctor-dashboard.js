document.addEventListener('DOMContentLoaded', function() {
    fetchDashboardData();
});

function fetchDashboardData() {
    fetch('../../functions/doctor-dashboard/doctor_dashboard_data.php')
        .then(response => response.json())
        .then(data => {
            updateDashboardCounts(data);
            updateAppointmentsTable(data.todays_appointments);
            updateCurrentPatients(data.current_patients);
        })
        .catch(error => console.error('Error:', error));
}

function updateDashboardCounts(data) {
    document.getElementById('assigned-patients-count').textContent = data.assigned_patients || 0;
    document.getElementById('pending-tasks-count').textContent = data.pending_tasks || 0;
    document.getElementById('critical-patients-count').textContent = data.critical_patients || 0;
    document.getElementById('new-consultations-count').textContent = data.new_consultations || 0;
    
    updateChangeIndicator('assigned-patients-change', data.assigned_patients_change);
    updateChangeIndicator('critical-patients-change', data.critical_patients_change);
    updateChangeIndicator('consultations-change', data.consultations_change);
    
    document.getElementById('pending-tasks-date').textContent = 
        new Date().toLocaleDateString('en-US', { month: 'long', day: 'numeric', year: 'numeric' });
}

function updateChangeIndicator(elementId, change) {
    const element = document.getElementById(elementId);
    if (element && change !== undefined) {
        element.textContent = `${change > 0 ? '+' : ''}${change} more than last month`;
    }
}

function updateAppointmentsTable(appointments) {
    const tbody = document.querySelector('.table tbody');
    if (!tbody || !appointments) return;

    tbody.innerHTML = appointments.map(apt => `
        <tr>
            <td>${formatTime(apt.appointment_time)}</td>
            <td>${apt.patient_name}</td>
            <td>${apt.appointment_type}</td>
            <td><span class="badge bg-${getStatusBadge(apt.status)}">${apt.status}</span></td>
            <td><button class="btn btn-sm btn-${apt.status === 'scheduled' ? 'primary' : 'secondary'}" 
                onclick="handleAppointment(${apt.appointment_id})">
                ${apt.status === 'scheduled' ? 'Start Session' : 'View Details'}
            </button></td>
        </tr>
    `).join('');
}

function updateCurrentPatients(patients) {
    const patientList = document.querySelector('.patient-list');
    if (!patientList || !patients) return;

    patientList.innerHTML = patients.map(patient => `
        <div class="mb-4">
            <div class="d-flex justify-content-between align-items-center mb-2">
                <div>
                    <h6 class="mb-1">${patient.patient_name}</h6>
                    <small class="text-muted">ID: P${String(patient.patient_id).padStart(3, '0')}</small>
                </div>
                <div class="action-icons">
                    <a href="#" onclick="viewPatient(${patient.patient_id})"><i class="fas fa-clipboard"></i></a>
                    <a href="#" onclick="editPatient(${patient.patient_id})"><i class="fas fa-edit"></i></a>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <small>${patient.age}/${patient.gender} - ${patient.conditions || 'No conditions'}</small>
                <span class="badge bg-${patient.patient_status === 'inpatient' ? 'danger' : 'success'}">
                    ${patient.patient_status}
                </span>
            </div>
        </div>
    `).join('');
}

function getStatusBadge(status) {
    const badges = {
        'scheduled': 'warning',
        'completed': 'success',
        'cancelled': 'danger'
    };
    return badges[status] || 'secondary';
}

function formatTime(time) {
    return new Date(`1970-01-01T${time}`).toLocaleTimeString([], 
        { hour: '2-digit', minute: '2-digit' });
}

// Refresh data every 5 minutes
setInterval(fetchDashboardData, 300000);

// Placeholder functions for click handlers
function handleAppointment(id) {
    console.log(`Handling appointment ${id}`);
}

function viewPatient(id) {
    console.log(`Viewing patient ${id}`);
}

function editPatient(id) {
    console.log(`Editing patient ${id}`);
}