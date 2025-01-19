function openViewModal(records) {
    let content = '';
    records.forEach(record => {
        content += `
            <strong>Complainant Name:</strong> ${record.complainant_name}<br />
            <strong>Complainant Position:</strong> ${record.complainant_position}<br />
            <strong>Complainant Contact:</strong> ${record.complainant_contact}<br />
            <strong>Incident Date:</strong> ${record.incident_date}<br />
            <strong>Incident Time:</strong> ${record.incident_time}<br />
            <strong>Incident Location:</strong> ${record.incident_location}<br />
            <strong>Violation Type:</strong> ${record.violation_type}<br />
            <strong>Complaint Details:</strong> ${record.complaint_details}<br />
            <strong>Action Taken:</strong> ${record.action_taken}<br />
       <div class="mt-4">
                <a href="/complaints/${record.id}" 
                   class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                   Full Details
                </a>
            </div>
            <hr class="my-4" />
        `;
    });
    document.getElementById('modalTitle').innerText = `Complaint Details`;
    document.getElementById('modalContent').innerHTML = content;
    document.getElementById('complaintModal').style.display = 'flex';
}

function closeViewModal() {
    document.getElementById('complaintModal').style.display = 'none';
}


// Open the modal and populate form fields
// Open the modal and populate form fields
function openModal(recordId) {
    const record = records[recordId];
    
    // Set the form action to the correct route
    const form = document.getElementById('editForm');
    form.action = `/derogatory-record-histories/${recordId}`;
    
    // Populate the form fields
    document.getElementById('violation').value = record.violation.violation_name;
    document.getElementById('action_taken').value = record.action_taken;
    document.getElementById('penalty').value = record.penalty ?? '';
    document.getElementById('settled').value = record.settled ? '1' : '0';
    
    // Display "Approved by" if it exists in the record
    const approvedByField = document.getElementById('approved_by');
    if (record.approved_by) {
        approvedByField.value = record.approved_by;
    } else {
        approvedByField.value = '';  // Reset if no data
    }

    // Show the modal
    document.getElementById('editModal').classList.remove('hidden');
    
    // Toggle the visibility of the "Approved by" field based on "Settled"
    toggleApprovedBy();
}

// Close the modal
function closeModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Function to toggle the visibility of the "Approved by" field
function toggleApprovedBy() {
    const settled = document.getElementById('settled').value;
    const approvedByDiv = document.getElementById('approvedByDiv');
    const approvedByField = document.getElementById('approved_by');

    // Show the "Approved by" field if "Settled" is "Yes"
    if (settled === '1') {
        approvedByDiv.classList.remove('hidden');
    } else {
        approvedByDiv.classList.add('hidden');
        approvedByField.value = '';  // Clear the "Approved by" field if "Settled" is "No"
    }
}

// Function to toggle the visibility of the "Approved by" field
function toggleApprovedBy() {
    const settled = document.getElementById('settled').value;
    const approvedByDiv = document.getElementById('approvedByDiv');

    // Show the "Approved by" field if "Settled" is "Yes"
    if (settled === '1') {
        approvedByDiv.classList.remove('hidden');
    } else {
        approvedByDiv.classList.add('hidden');
    }
}


function showCustomViolationModal() {
    // Show the custom violation modal when the "Custom" radio button is selected
    document.getElementById('customViolationModal').classList.remove('hidden');
}

function closeCustomViolationModal() {
    // Close the custom violation modal
    document.getElementById('customViolationModal').classList.add('hidden');
}
function toggleViolationType(type) {
    console.log('Violation Type Selected:', type);  // Debugging line
    // Show/hide dropdowns based on violation type selection
    if (type === 'Major') {
        document.getElementById('major_violation_dropdown').style.display = 'block';
        document.getElementById('minor_violation_dropdown').style.display = 'none';
    } else if (type === 'Minor') {
        document.getElementById('minor_violation_dropdown').style.display = 'block';
        document.getElementById('major_violation_dropdown').style.display = 'none';
    } else {
        document.getElementById('major_violation_dropdown').style.display = 'none';
        document.getElementById('minor_violation_dropdown').style.display = 'none';
    }
}
document.addEventListener('DOMContentLoaded', () => {
    const openModal = document.getElementById('openViolationModal');
    const closeModal = document.getElementById('closeViolationModal');
    const modal = document.getElementById('violationModal');
    const violationInput = document.getElementById('violation_id');
    const violationButton = document.getElementById('openViolationModal');

    // Open the modal
    openModal.addEventListener('click', () => {
        modal.classList.remove('hidden');
    });

    // Close the modal
    closeModal.addEventListener('click', () => {
        // Ensure the violation_id remains unset when closing the modal without selection
        if (violationInput.value === 'default_violation_id') {
            violationInput.value = ''; // Reset the hidden input value
            violationButton.textContent = 'Select Violation'; // Reset the button text
        }
        modal.classList.add('hidden');
    });

    // Handle violation selection
    document.querySelectorAll('.selectViolation').forEach(button => {
        button.addEventListener('click', () => {
            const id = button.getAttribute('data-id');
            const name = button.getAttribute('data-name');
            violationInput.value = id; // Set the hidden input value correctly
            violationButton.textContent = name; // Update button text for user feedback
            modal.classList.add('hidden'); // Close the modal
        });
    });

    // Add validation to prevent form submission if violation_id is null
    const form = document.querySelector('form'); // Assuming you're submitting the form

    if (form) {
        form.addEventListener('submit', (e) => {
            if (!violationInput.value || violationInput.value === 'default_violation_id') {
                e.preventDefault(); // Prevent form submission if violation_id is not set or is default
                alert('Please select a violation before submitting the form.');
            }
        });
    }
});


