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
    
    // Show the modal
    document.getElementById('editModal').classList.remove('hidden');
}

function closeModal() {
    // Hide the modal
    document.getElementById('editModal').classList.add('hidden');
}
document.addEventListener('DOMContentLoaded', function () {
    const complainantType = document.getElementById('complainant_type');
    const studentIdContainer = document.getElementById('complainant_student_id_container');

    complainantType.addEventListener('change', function () {
        if (complainantType.value === 'student') {
            studentIdContainer.style.display = 'block';
        } else {
            studentIdContainer.style.display = 'none';
        }
    });
});
function toggleViolationType(type) {
    document.getElementById('major_violation_dropdown').style.display = type === 'Major' ? 'block' : 'none';
    document.getElementById('minor_violation_dropdown').style.display = type === 'Minor' ? 'block' : 'none';
}

