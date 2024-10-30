const patientStatus = document.getElementById('patient-status').getContext('2d');

const chartPatient = new Chart(patientStatus, {
    type: 'bar',
    data: {
        labels: ['Mon', 'Tues', 'Wed', 'Thurs', 'Fri', 'Sat', 'Sun'],
        datasets: [
            {
                label: 'Inpatient',
                data: [12, 19, 15, 10, 30, 20, 5],
                backgroundColor: '#2176D1',
            },
            {
                label: 'Outpatient',
                data: [20, 15, 22, 30, 0, 6, 10],
                backgroundColor: '#FD850F',
            },
            {
                label: 'Emergency',
                data: [5, 10, 7, 12, 5, 20, 25],
                backgroundColor: '#D71C1E',
            },
            {
                label: 'Discharged',
                data: [8, 13, 9, 11, 10, 9, 0],
                backgroundColor: '#11D2C3',
            }
        ]
        },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        },
        plugins: {
            legend: {
                display: true,
                position: 'top',
            },
            tooltip: {
                mode: 'index',
                intersect: false,
            }
        }
    }
});