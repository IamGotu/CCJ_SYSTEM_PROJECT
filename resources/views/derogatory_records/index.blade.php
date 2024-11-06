<!-- resources/views/derogatory_records/index.blade.php -->
@extends('layouts.app')

@section('content')
<main class="p-4">
    <h2 class="text-2xl font-bold mb-4">Students Derogatory Records</h2>
    <p class="mb-4">This module contains records of students with derogatory notes. Below is the list of students with their details.</p>
    
    <!-- Search Filter -->
    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search by student initials or student number..." title="Type student initials">

    <!-- Button to Open Create Modal -->
    <button onclick="document.getElementById('createForm').style.display='block'" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Add New Record</button>

    <h3 class="text-xl font-semibold mt-6">Student Information</h3>
    
    <table id="studentsTable" class="min-w-full bg-white border border-gray-300 mb-4">
        <thead>
            <tr>
                <th>Student Number</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Middle Name</th>
                <th>Year Graduated</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($derogatoryRecords as $record)
                <tr>
                    <td>{{ $record->student_number }}</td>
                    <td>{{ $record->last_name }}</td>
                    <td>{{ $record->first_name }}</td>
                    <td>{{ $record->middle_name }}</td>
                    <td>{{ $record->year_graduated }}</td>
                    <td>
                        <a href="{{ route('derogatory_records.show', $record->id) }}" class="text-blue-500">View</a> |
                        <button onclick="editRecord({{ $record->id }})" class="text-yellow-500">Edit</button> |
                        <form action="{{ route('derogatory_records.destroy', $record->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Create Record Modal -->
    <div id="createForm" class="modal hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center">
        <form action="{{ route('derogatory_records.store') }}" method="POST" class="bg-white p-6 rounded">
            @csrf
            <h3 class="text-xl font-semibold mb-4">Add New Derogatory Record</h3>
            
            <!-- Fields for Student Information -->
            <label for="student_number" class="block font-medium">Student Number:</label>
            <input type="text" id="student_number" name="student_number" class="w-full p-2 border rounded mb-4" required>
            
            <label for="last_name" class="block font-medium">Last Name:</label>
            <input type="text" id="last_name" name="last_name" class="w-full p-2 border rounded mb-4" required>
            
            <label for="first_name" class="block font-medium">First Name:</label>
            <input type="text" id="first_name" name="first_name" class="w-full p-2 border rounded mb-4" required>

            <label for="middle_name" class="block font-medium">Middle Name:</label>
            <input type="text" id="middle_name" name="middle_name" class="w-full p-2 border rounded mb-4">

            <label for="year_graduated" class="block font-medium">Year Graduated:</label>
            <input type="number" id="year_graduated" name="year_graduated" class="w-full p-2 border rounded mb-4">

            <label for="violation" class="block font-medium">Violation:</label>
            <input type="text" id="violation" name="violation" class="w-full p-2 border rounded mb-4">

            <label for="action_taken" class="block font-medium">Action Taken:</label>
            <input type="text" id="action_taken" name="action_taken" class="w-full p-2 border rounded mb-4">

            <label for="settled" class="block font-medium">Settled:</label>
            <select id="settled" name="settled" class="w-full p-2 border rounded mb-4">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <label for="sanction" class="block font-medium">Sanction:</label>
            <select id="sanction" name="sanction" class="w-full p-2 border rounded mb-4">
                <option value="suspension">Suspension</option>
                <option value="expulsion">Expulsion</option>
                <option value="verbal_warning">Verbal Warning</option>
                <option value="written_warning">Written Warning</option>
                <option value="others">Others</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Record</button>
            <button type="button" onclick="document.getElementById('createForm').style.display='none'" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </form>
    </div>

    <!-- Edit Record Modal -->
    <div id="editForm" class="modal hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center">
        <form id="editRecordForm" method="POST" class="bg-white p-6 rounded">
            @csrf
            @method('PUT')
            <h3 class="text-xl font-semibold mb-4">Edit Derogatory Record</h3>
            
            <!-- Fields for Editing Information -->
            <label for="edit_student_number" class="block font-medium">Student Number:</label>
            <input type="text" id="edit_student_number" name="student_number" class="w-full p-2 border rounded mb-4" required>
            
            <label for="edit_last_name" class="block font-medium">Last Name:</label>
            <input type="text" id="edit_last_name" name="last_name" class="w-full p-2 border rounded mb-4" required>
            
            <label for="edit_first_name" class="block font-medium">First Name:</label>
            <input type="text" id="edit_first_name" name="first_name" class="w-full p-2 border rounded mb-4" required>

            <label for="edit_middle_name" class="block font-medium">Middle Name:</label>
            <input type="text" id="edit_middle_name" name="middle_name" class="w-full p-2 border rounded mb-4">

            <label for="edit_year_graduated" class="block font-medium">Year Graduated:</label>
            <input type="number" id="edit_year_graduated" name="year_graduated" class="w-full p-2 border rounded mb-4">

            <label for="edit_violation" class="block font-medium">Violation:</label>
            <input type="text" id="edit_violation" name="violation" class="w-full p-2 border rounded mb-4">

            <label for="edit_action_taken" class="block font-medium">Action Taken:</label>
            <input type="text" id="edit_action_taken" name="action_taken" class="w-full p-2 border rounded mb-4">

            <label for="edit_settled" class="block font-medium">Settled:</label>
            <select id="edit_settled" name="settled" class="w-full p-2 border rounded mb-4">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>

            <label for="edit_sanction" class="block font-medium">Sanction:</label>
            <select id="edit_sanction" name="sanction" class="w-full p-2 border rounded mb-4">
                <option value="suspension">Suspension</option>
                <option value="expulsion">Expulsion</option>
                <option value="verbal_warning">Verbal Warning</option>
                <option value="written_warning">Written Warning</option>
                <option value="others">Others</option>
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Record</button>
            <button type="button" onclick="document.getElementById('editForm').style.display='none'" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
        </form>
    </div>
</main>

<script>
    // JavaScript for handling the Edit Record modal display
    function editRecord(recordId) {
        // Load the record data via AJAX or set manually for now
        document.getElementById('editForm').style.display = 'block';
        // Set action URL and form data for editing the record (replace with actual record data if using AJAX)
        document.getElementById('editRecordForm').action = `/derogatory_records/${recordId}`;
    }

    // Filter table for search functionality
    function filterTable() {
        // Implement search functionality
    }
</script>
@endsection
