document.addEventListener('DOMContentLoaded', function() {
    let patientId;
    // Tab handling
    const medicalLinks = document.querySelectorAll('.nav-link.medical');
    
    medicalLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Remove active class from all links and tab panes
            medicalLinks.forEach(navLink => {
                navLink.classList.remove('active');
            });
            
            document.querySelectorAll('.tab-pane').forEach(pane => {
                pane.classList.remove('active', 'show');
            });
            
            // Add active class to clicked link
            this.classList.add('active');
            
            // Get the target tab from href and activate it
            const tabId = this.getAttribute('href');
            const targetTab = document.querySelector(tabId);
            if (targetTab) {
                targetTab.classList.add('active', 'show');
            }
        });
    });

    // Modal handling
    const displayModal = document.getElementById('displayModal');

    // attach event listerner to the madal's 'shown.bs.modal' event
   displayModal.addEventListener('shown.bs.modal', function(event) {
        // get the button that triggered the modal
        const button = event.relatedTarget;
        patientId = button.getAttribute('data-id');

        console.log(patientId);

        if (patientId) {
            // fetch patient details
            getInfo(patientId);
        }
   });

    // function to fetch and display patient details
    async function getInfo() {
        try {
            const response = await fetch(`../../functions/manage_patient/display_info.inc.php?id=${patientId}`);
            if (!response.ok) {
                throw new Error('Network response was not ok ' + response.statusText);
            }
            const data = await response.json();
            console.log(data);

            // populate the modal with patient detials
            console.log(patientId);
            populateModal(data);
        } catch (error) {
            console.error('There has been a problem with your fetch operation:', error);
        }
    };

    function clearTable(dataTable) {
        dataTable.innerHTML = ''; // Clears all rows in the <tbody>
    }

    // function to populate the modal with the fetched data
    function populateModal(data) {
        console.log(data);
        // load patient vitals
        document.getElementById('blood_pressure').textContent = data.Vitals['blood_pressure'] + ' ' + 'mmHg';
        document.getElementById('heart_rate').textContent = data.Vitals['heart_rate'] + ' ' + 'bpm';
        document.getElementById('temperature').textContent = data.Vitals['temperature'] + ' ' + '°C';

        // load patient basic info
        document.getElementById('patientID').textContent = data.BasicInfo['patient_id'] || 'N/A';
        document.getElementById('patientName').textContent = data.BasicInfo['full_name'] || 'N/A';
        document.getElementById('patientAge').textContent = data.BasicInfo['age'] || 'N/A';
        document.getElementById('patientGender').textContent = data.BasicInfo['gender'] || 'N/A';
        document.getElementById('patientDepartment').textContent = data.BasicInfo['departments'] || 'N/A';
        document.getElementById('statusInfo').textContent = data.BasicInfo['status'] || 'N/A';
        document.getElementById('statusInfo').classList.add(`${data.BasicInfo['status']}`);

        document.getElementById('patientAdmissionDate').textContent = data.BasicInfo['admission_date'] || 'N/A';

        // load patient contact information
        document.getElementById('patientContact').textContent = data.BasicInfo['contact_number'] || 'N/A';
        document.getElementById('patientEmail').textContent = data.BasicInfo['email'] || 'N/A';
        document.getElementById('patientAddress').textContent = data.BasicInfo['address'] || 'N/A';

        // load diagnosis data
        const DiagnosisMessage = document.getElementById("diagnosis-message");
        const DiagnosisTableElement = document.getElementById("diagnosis-table");
        const DiagnosisTableBodyElement = document.getElementById("diagnosis-table-body");

        clearTable(DiagnosisTableBodyElement);
        if (data.MedicalHistory === "No medical history found for patient with specified ID") {
            // Show the message if no data is available
            DiagnosisMessage.style.display = "block";
            DiagnosisTableElement.style.display = "none";
        } else {
            // Hide the message and show the table
            DiagnosisMessage.style.display = "none";
            DiagnosisTableElement.style.display = "table";

            // Populate the table with data
            data.MedicalHistory.forEach((item) => {
                const row = document.createElement("tr");

                // Create cells for each property
                const conditionName = document.createElement("td");
                conditionName.textContent = item.condition_name;

                const caseCondition  = document.createElement("td");
                caseCondition.textContent = item.case_condition;

                const date = document.createElement("td");
                date.textContent = item.diagnosis_date;

                const notes = document.createElement('td');
                notes.textContent = item.notes;

                // Append cells to the row
                row.appendChild(conditionName);
                row.appendChild(caseCondition);
                row.appendChild(date);
                row.appendChild(notes);

                // Append row to the table body
                DiagnosisTableBodyElement.appendChild(row);
            });
        }

        // load medications data
        const MedicationsMessage = document.getElementById("medications-message");
        const MedicationsTableElement = document.getElementById("medications-table");
        const MedicationsTableBodyElement = document.getElementById("medications-table-body");
        clearTable(MedicationsTableBodyElement);

        if (data.CurrentMeds === "No patient medications found with specified ID") {
            // Show the message if no data is available
            MedicationsMessage.style.display = "block";
            MedicationsTableElement.style.display = "none";
        } else {
            // Hide the message and show the table
            MedicationsMessage.style.display = "none";
            MedicationsTableElement.style.display = "table";

            // Populate the table with data
            data.CurrentMeds.forEach((item) => {
                const row = document.createElement("tr");

                // Create cells for each property
                const medicationsName = document.createElement("td");
                medicationsName.textContent = item.medication_name;

                const dosage  = document.createElement("td");
                dosage.textContent = item.dosage;

                const frequency = document.createElement("td");
                frequency.textContent = item.frequency;

                const prescribedBy = document.createElement('td');
                prescribedBy.textContent = item.prescribed_by_doctor;

                const startDate = document.createElement("td");
                startDate.textContent = item.start_date;

                const endDate = document.createElement('td');
                endDate.textContent = item.end_date;

                // Append cells to the row
                row.appendChild(medicationsName);
                row.appendChild(dosage);
                row.appendChild(frequency);
                row.appendChild(prescribedBy)
                row.appendChild(startDate);
                row.appendChild(endDate);

                // Append row to the table body
                MedicationsTableBodyElement.appendChild(row);
            });
        }

        // load allergies data
        const AllergiesMessage = document.getElementById("allergies-message");
        const AllergiesTableElement = document.getElementById("allergies-table");
        const AllergiesTableBodyElement = document.getElementById("allergies-table-body");
        clearTable(AllergiesTableBodyElement);

        if (data.Allergies === "No patient allergies found with specified ID") {
            // Show the message if no data is available
            AllergiesMessage.style.display = "block";
            AllergiesTableElement.style.display = "none";
        } else {
            // Hide the message and show the table
            AllergiesMessage.style.display = "none";
            AllergiesTableElement.style.display = "table";

            // Populate the table with data
            data.Allergies.forEach((item) => {
                const row = document.createElement("tr");

                // Create cells for each property
                const conditionName = document.createElement("td");
                conditionName.textContent = item.allergy_type;

                const caseCondition  = document.createElement("td");
                caseCondition.textContent = item.severity;

                const notes = document.createElement('td');
                notes.textContent = item.notes;

                // Append cells to the row
                row.appendChild(conditionName);
                row.appendChild(caseCondition);
                row.appendChild(notes);

                // Append row to the table body
                AllergiesTableBodyElement.appendChild(row);
            });
        }

        // load the lab results
        const LabMessage = document.getElementById("lab-message");
        const LabTableElement = document.getElementById("lab-table");
        const LabTableBodyElement = document.getElementById("lab-table-body");
        clearTable(LabTableBodyElement);

        if (data.LabResults === "No patient lab results found with specified ID") {
            // Show the message if no data is available
            LabMessage.style.display = "block";
            LabTableElement.style.display = "none";
        } else {
            // Hide the message and show the table
            LabMessage.style.display = "none";
            LabTableElement.style.display = "table";

            // Populate the table with data
            data.LabResults.forEach((item) => {
                const row = document.createElement("tr");

                // Create cells for each property
                const conditionName = document.createElement("td");
                conditionName.textContent = item.test_type;

                const caseCondition  = document.createElement("td");
                caseCondition.textContent = item.test_date;

                const result = document.createElement('td');
                result.textContent = item.result;

                const normal_range = document.createElement("td");
                normal_range.textContent = item.normal_range;

                const performedBy = document.createElement('td');
                notes.textContent = item.notes;

                // Append cells to the row
                row.appendChild(conditionName);
                row.appendChild(caseCondition);
                row.appendChild(result);
                row.appendChild(normal_range);
                row.appendChild(notes);

                // Append row to the table body
                LabTableBodyElement.appendChild(row);
            });
        }
    }
});