function calculateAge(birthDateString) {
    const birthDate = new Date(birthDateString);
    const today = new Date();

    let age = today.getFullYear() - birthDate.getFullYear();
    const monthDifference = today.getMonth() - birthDate.getMonth();
    const dayDifference = today.getDay() - birthDate.getDay();

    if (monthDifference < 0 || (monthDifference === 0 && dayDifference < 0)) {
        age--;
    }
    return age;
}

// Fetch the JSON data from the PHP script
fetch('../../functions/fetch_patients.inc.php')
.then(response => response.json())
.then(data => {
    // Check if data is an array (contains patients) or if it's an error message
    if (Array.isArray(data)) {
        // Populate the table with the patient data
        const tableBody = document.getElementById('patientTable').querySelector('tbody');
        const modals = document.getElementById('modals')
        data.forEach(patient => {
            const row = document.createElement('tr');
            const modal = document.createElement('div');


            row.setAttribute('data-id', patient["Patient ID"]);
            // console.log(patient["Patient ID"]);
            age = calculateAge(patient["Age"])

            console.log(age);
            fullName = patient["first_name"] + ' ' + patient["last_name"]
            console.log(patient['first_name']);
            

            row.innerHTML = `
                <td>${patient["Patient ID"]}</td>
                <td>${fullName}</td>
                <td>${age}</td>
                <td>${patient["Gender"]}</td>
                <td>${patient["Admission Date"]}</td>
                <td><div class="status ${patient["Status"]}">${patient["Status"]}</div></td>
                <td>
                    <div class="selected-actions" id="selectedActions">
                        <button type="button" class="action-btn edit-btn" data-id="${patient["Patient ID"]}">
                            <span class="action-icon">✏️</span> Edit
                        </button>
                        <button class="action-btn remove-btn" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal" data-id="${patient["Patient ID"]}">
                            <span class="action-icon">🗑️</span> Remove
                        </button>
                        <button class="action-btn open-btn" data-bs-toggle="modal" data-bs-target="#displayModal" data-id="${patient["Patient ID"]}">
                            <span class="action-icon">📂</span> Open
                        </button>
                    </div>
                </td>
            `;
            tableBody.appendChild(row);

        });
    } else {
        // Handle case where no patients are available
        alert(data.message || "No patients data available.");
    }
})
.catch(error => console.error('Error fetching patient data:', error));