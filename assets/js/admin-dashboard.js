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

// initilize charts when page loads
initializeCharts();