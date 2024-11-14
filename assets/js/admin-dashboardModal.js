// const response = fetch('../../functions/admin-dashboard/get_modal_data.inc.php');
// const data = await response.json();

const API_ENDPOINTS = {
    patients: '../../functions/admin-dashboard/get_modal_data.inc.php?type=patients',
    critical: '../../functions/admin-dashboard/get_modal_data.inc.php?type=critical',
    staff: '../../functions/admin-dashboard/get_modal_data.inc.php?type=staff',
    appointments: '../../functions/admin-dashboard/get_modal_data.inc.php?type=appointments'
};

// table definitions for the different modal types
const TABLE_COLUMNS = {
    patients: [
      { key: 'patientId', label: 'Patient ID' },
      { key: 'name', label: 'Patient Name' },
      { key: 'admissionDate', label: 'Admission Date' },
      { key: 'department', label: 'Department' },
      { key: 'doctor', label: 'Doctor Name'}
    ],
    critical: [
      { key: 'patientId', label: 'Patient ID' },
      { key: 'name', label: 'Name' },
      { key: 'condition', label: 'Condition' },
      { key: 'status', label: 'Status' }
    ],
    staff: [
      { key: 'name', label: 'Name' },
      { key: 'email', label: 'email' },
      { key: 'role', label: 'Role' },
      { key: 'department', label: 'Department' }
    ],
    appointments: [
      { key: 'date', label: 'Date' },
      { key: 'time', label: 'Time' },
      { key: 'patient', label: 'Patient' },
      { key: 'doctor', label: 'Doctor' },
      { key: 'status', label: 'Status' }
    ]
};

// modal titles
const MODAL_TITLES = {
    patients: 'Active Patients',
    critical: 'Critical Patients',
    staff: 'Staff Management',
    appointments: 'Appointment Details'
};

async function fetchData(type) {
    try {
        const response = await fetch(API_ENDPOINTS[type]);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.json();
        return data;
    } catch (error) {
        console.error('Error fetching data: ', error);
        throw error;
    }
}

function generateTable(columns, data) {
    return `
    <div class="space-y-6">
      <div class="bg-white rounded-md shadow overflow-x-auto">
        <table class="w-full border-collapse">
          <thead>
            <tr>
              ${columns.map(col => 
                `<th class="p-3 text-left border-b">${col.label}</th>`
              ).join('')}
            </tr>
          </thead>
          <tbody>
            ${data.map(row => `
              <tr>
                ${columns.map(col => 
                  `<td class="p-3 border-b">${row[col.key] || ''}</td>`
                ).join('')}
              </tr>
            `).join('')}
          </tbody>
        </table>
      </div>
    </div>
    `;
};

function showLoadingState(modalContent) {
    modalContent.innerHTML = `
    <div class="flex items-center justify-center p-8">
      <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-500"></div>
    </div>
    `;
}

function showErrorState(modalContent, error) {
    modalContent.innerHTML = `
        <div class="p-4 text-red-500 text-center">
        <p>Error loading data: ${error.message}</p>
        <button onclick="retryFetch()" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
            Retry
        </button>
        </div>
    `;
}

async function openModal(type) {
    const modal = document.getElementById('modal');
    const modalTitle = document.getElementById('modal-title');
    const modalContent = document.getElementById('modal-content');
    
    // show modal immediately with loading state
    modal.classList.remove('opacity-0', 'pointer-events-none');
    modal.classList.add('opacity-100');

    // set title
    modalTitle.textContent = MODAL_TITLES[type];

    // show loading state
    showLoadingState(modalContent);

    try {
        const data = await fetchData(type);

        // generate and set table content
        modalContent.innerHTML = generateTable(TABLE_COLUMNS[type], data);
    } catch (error) {
        showErrorState(modalContent, error)
    }
}

function closeModal() {
    const modal = document.getElementById('modal');
    modal.classList.remove('opacity-100');
    modal.classList.add('opacity-0', 'pointer-events-none');
}

document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') {
        closeModal();
    }
});
