// Fetch the JSON data from the PHP script
fetch('../../functions/fetch_users.inc.php')
.then(response => response.json())
.then(data => {
    // Check if data is an array (contains patients) or if it's an error message
    if (Array.isArray(data)) {
        // Populate the table with the patient data
        const tableBody = document.getElementById('userTable').querySelector('tbody');
        data.forEach(patient => {
            const row = document.createElement('tr');

            row.setAttribute('data-id', patient["user_id"]);
            // console.log(patient["Patient ID"]);
            

            row.innerHTML = `
                <td>${patient["user_id"]}</td>
                <td>${patient["Full Name"]}</td>
                <td>${patient["phone_number"]}</td>
                <td>${patient["email"]}</td>
                <td>${patient["user_department"]}</td>
                <td>${patient["userrole"]}</td>
                <td>
                    <div class="selected-actions" id="selectedActions">
                        <button type="button" class="action-btn edit-btn" data-bs-toggle="modal" data-bs-target="#myModal" onclick="openPatientModal()">
                            <span class="action-icon">✏️</span> Edit
                        </button>
                        <button class="action-btn remove-btn">
                            <span class="action-icon">🗑️</span> Remove
                        </button>
                        <button class="action-btn open-btn" onclick="">
                            <span class="action-icon">📂</span> Open
                        </button>
                        <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">Open modal</button> -->
                    </div>
                </td>
            `;
            tableBody.appendChild(row);
        });
    } else {
        // Handle case where no patients are available
        alert(data.message || "No users data available.");
    }
})
.catch(error => console.error('Error fetching user data:', error));