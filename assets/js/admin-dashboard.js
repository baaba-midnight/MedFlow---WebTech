// use ajax to get response from database
async function initializeCharts() {
    // fetch to initialise charts
    const response = await fetch('../../functions/admin-dashboard/get_dashboard_data.inc.php');
    const data = await response.json();
    
    // update stats
    console.log("data: ",data.quickStats[0].activePatients);
    document.getElementById('active-patients-count').textContent = data.quickStats[0].activePatients;
    document.getElementById('critical-patients-count').textContent = data.quickStats[0].criticalPatients;
    document.getElementById('pending-appointments-count').textContent = data.quickStats[0].todayAppointments;
    document.getElementById('staff-count').textContent = data.quickStats[0].totalStaff;

    // patient status pie chart
    new Chart(document.getElementById('patient-status'), {
        type: 'pie',
        data: {
            labels: data.patientStatus.map(item => item.name),
            datasets: [{
                data: data.patientStatus.map(item => item.value),
                backgroundColor: [
                    '#2176D1',
                    '#FD850F',
                    '#11D2C3'
                ]
            }]
            },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom',
                },
                title: {
                    display: true,
                    text: 'Patient Status Distribution'
                }
            }
        }
    });

    // Patient by Department Stats
    new Chart(document.getElementById('patient-by-department'), {
        type: 'bar',
        data: {
            labels: data.departmentCount.map(item => item.department),
            datasets: [{
                label: 'Number of Patients',
                data: data.departmentCount.map(item => item.patients),
                backgroundColor: '#3b82f6'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                title: {
                    display: true,
                    text: 'Patients by Department'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

// Modal settings
function openModal(type) {
const modal = document.getElementById('modal');
const modalTitle = document.getElementById('modal-title');
const modalContent = document.getElementById('modal-content');

// get data for each modal
const tableBody = document.getElementById()

switch (type) {
    case 'patients':
    modalTitle.textContent = 'Patient Overview';
    modalContent.innerHTML = `
        <div class="space-y-6">
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full border-collapse">
            <thead>
                <tr>
                <th class="p-3 text-left border-b">Patient ID</th>
                <th class="p-3 text-left border-b">Name</th>
                <th class="p-3 text-left border-b">Department</th>
                <th class="p-3 text-left border-b">Admission Date</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td class="p-3 border-b">P-001</td>
                <td class="p-3 border-b">John Doe</td>
                <td class="p-3 border-b">Internal Medicine</td>
                <td class="p-3 border-b">2023-04-15</td>
                </tr>
                <tr>
                <td class="p-3 border-b">P-002</td>
                <td class="p-3 border-b">Jane Smith</td>
                <td class="p-3 border-b">Pediatrics</td>
                <td class="p-3 border-b">2023-05-01</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    `;
    break;

    case 'critical':
    modalTitle.textContent = 'Critical Patients';
    modalContent.innerHTML = `
        <div class="space-y-6">
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full border-collapse">
            <thead>
                <tr>
                <th class="p-3 text-left border-b">Patient ID</th>
                <th class="p-3 text-left border-b">Name</th>
                <th class="p-3 text-left border-b">Unit</th>
                <th class="p-3 text-left border-b">Condition</th>
                <th class="p-3 text-left border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td class="p-3 border-b">P-001</td>
                <td class="p-3 border-b">John Doe</td>
                <td class="p-3 border-b">ICU</td>
                <td class="p-3 border-b">Respiratory Failure</td>
                <td class="p-3 border-b">Critical</td>
                </tr>
                <tr>
                <td class="p-3 border-b">P-002</td>
                <td class="p-3 border-b">Jane Smith</td>
                <td class="p-3 border-b">CCU</td>
                <td class="p-3 border-b">Cardiac Arrest</td>
                <td class="p-3 border-b">Stable</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    `;
    break;

    case 'staff':
    modalTitle.textContent = 'Staff Management';
    modalContent.innerHTML = `
        <div class="space-y-6">
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full border-collapse">
            <thead>
                <tr>
                <th class="p-3 text-left border-b">Name</th>
                <th class="p-3 text-left border-b">Role</th>
                <th class="p-3 text-left border-b">Department</th>
                <th class="p-3 text-left border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td class="p-3 border-b">Dr. Smith</td>
                <td class="p-3 border-b">Senior Doctor</td>
                <td class="p-3 border-b">Cardiology</td>
                <td class="p-3 border-b">On Duty</td>
                </tr>
                <tr>
                <td class="p-3 border-b">Nurse Johnson</td>
                <td class="p-3 border-b">Head Nurse</td>
                <td class="p-3 border-b">ICU</td>
                <td class="p-3 border-b">Off Duty</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    `;
    break;

    case 'appointments':
    modalTitle.textContent = 'Appointment Details';
    modalContent.innerHTML = `
        <div class="space-y-6">
        <div class="bg-white rounded-md shadow overflow-x-auto">
            <table class="w-full border-collapse">
            <thead>
                <tr>
                <th class="p-3 text-left border-b">Date</th>
                <th class="p-3 text-left border-b">Time</th>
                <th class="p-3 text-left border-b">Patient</th>
                <th class="p-3 text-left border-b">Doctor</th>
                <th class="p-3 text-left border-b">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <td class="p-3 border-b">2023-06-01</td>
                <td class="p-3 border-b">09:00 AM</td>
                <td class="p-3 border-b">John Doe</td>
                <td class="p-3 border-b">Dr. Smith</td>
                <td class="p-3 border-b">Completed</td>
                </tr>
                <tr>
                <td class="p-3 border-b">2023-06-02</td>
                <td class="p-3 border-b">10:30 AM</td>
                <td class="p-3 border-b">Jane Smith</td>
                <td class="p-3 border-b">Dr. Johnson</td>
                <td class="p-3 border-b">Pending</td>
                </tr>
            </tbody>
            </table>
        </div>
        </div>
    `;
    break;
}

modal.classList.remove('opacity-0', 'pointer-events-none');
modal.classList.add('opacity-100');
}

function closeModal() {
const modal = document.getElementById('modal');
modal.classList.remove('opacity-100');
modal.classList.add('opacity-0', 'pointer-events-none');
}

document.addEventListener('keydown', (event) => {
if (event.key === 'Escape') {
    closeModal();
}
});

// initilize charts when page loads
initializeCharts();