<!-- index.html -->
<!DOCTYPE html>
<html>
<head>
    <title>Patient Medications</title>
    <style>
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        .patient-select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
        }
        
        .medications-table {
            width: 100%;
            border-collapse: collapse;
        }
        
        .medications-table th,
        .medications-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        
        .medications-table th {
            background-color: #f4f4f4;
        }
        
        .medications-table tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        .loading {
            text-align: center;
            padding: 20px;
            display: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Patient Medications</h1>
        
        <select id="patientSelect" class="patient-select">
            <option value="">Select a patient</option>
        </select>
        
        <div id="loading" class="loading">Loading...</div>
        
        <table id="medicationsTable" class="medications-table">
            <thead>
                <tr>
                    <th>Medication</th>
                    <th>Dosage</th>
                    <th>Frequency</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Load patients when page loads
            $.ajax({
                url: './functions/manage_patient/get_medications.php',
                type: 'POST',
                data: {
                    action: 'getAllPatients'
                },
                success: function(response) {
                    const patients = JSON.parse(response);
                    let options = '<option value="">Select a patient</option>';
                    
                    patients.forEach(function(patient) {
                        options += `<option value="${patient.id}">${patient.patient_name}</option>`;
                    });
                    
                    $('#patientSelect').html(options);
                }
            });
            
            // Load medications when patient is selected
            $('#patientSelect').change(function() {
                const patientId = $(this).val();
                
                if (!patientId) {
                    $('#medicationsTable tbody').html('');
                    return;
                }
                
                $('#loading').show();
                $('#medicationsTable tbody').html('');
                
                $.ajax({
                    url: 'get_medications.php',
                    type: 'POST',
                    data: {
                        action: 'getPatientMeds',
                        patient_id: patientId
                    },
                    success: function(response) {
                        const medications = JSON.parse(response);
                        let rows = '';
                        
                        medications.forEach(function(med) {
                            rows += `
                                <tr>
                                    <td>${med.medication_name}</td>
                                    <td>${med.dosage}</td>
                                    <td>${med.frequency}</td>
                                    <td>${med.start_date}</td>
                                    <td>${med.end_date || 'Ongoing'}</td>
                                </tr>
                            `;
                        });
                        
                        $('#medicationsTable tbody').html(rows);
                        $('#loading').hide();
                    },
                    error: function() {
                        alert('Error loading medications');
                        $('#loading').hide();
                    }
                });
            });
        });
    </script>
</body>
</html>