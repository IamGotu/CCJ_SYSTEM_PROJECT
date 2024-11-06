<x-app-layout>
    <main class="p-4">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Students Derogatory Records</h2>
        <p class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">This module contains records of students with derogatory notes. Below is the list of students with their details.</p>
        
        <!-- Search Filter -->
        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search by student initials or student number..." title="Type student initials or student number" class="mb-4 p-2 border rounded">
        
        <!-- Button to Open Create Modal -->
        <button onclick="document.getElementById('createForm').style.display='block'" class="bg-green-500 text-white px-4 py-2 rounded mb-4">Add New Record</button>
        
        <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">Student Information</h3>
        <table id="studentsTable" class="min-w-full bg-white border border-gray-300 mb-4">
            <thead>
                <tr>
                    <th class="px-4 py-2">Student Number</th>
                    <th class="px-4 py-2">Last Name</th>
                    <th class="px-4 py-2">First Name</th>
                    <th class="px-4 py-2">Middle Name</th>
                    <th class="px-4 py-2">Year Graduated</th>
                    <th class="px-4 py-2">Violation</th>
                    <th class="px-4 py-2">Action Taken</th>
                    <th class="px-4 py-2">Settled</th>
                    <th class="px-4 py-2">Sanction</th>
                    <th class="px-4 py-2">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($derogatoryRecords as $record)
                    <tr>
                        <td class="px-4 py-2">{{ $record->student_number }}</td>
                        <td class="px-4 py-2">{{ $record->last_name }}</td>
                        <td class="px-4 py-2">{{ $record->first_name }}</td>
                        <td class="px-4 py-2">{{ $record->middle_name }}</td>
                        <td class="px-4 py-2">{{ $record->year_graduated }}</td>
                        <td class="px-4 py-2">{{ $record->violation }}</td>
                        <td class="px-4 py-2">{{ $record->action_taken }}</td>
                        <td class="px-4 py-2">{{ $record->settled }}</td>
                        <td class="px-4 py-2">{{ $record->sanction }}</td>
                        <td class="px-4 py-2">
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
            <form action="{{ route('derogatory_records.store') }}" method="POST" class="bg-white p-6 rounded" id="createRecordForm">
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
                    <option value="">Select...</option>
                    <option value="yes">Yes</option>
                    <option value="no">No</option>
                </select>

                <label for="sanction" class="block font-medium">Sanction:</label>
                <select id="sanction" name="sanction" class="w-full p-2 border rounded mb-4">
                    <option value="">Select...</option>
                    <option value="suspension">Suspension</option>
                    <option value="expulsion">Expulsion</option>
                    <!-- Add other options as needed -->
                </select>

                <!-- Submit and Cancel Buttons -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add Record</button> 
                <button type="button" onclick=" document.getElementById('createForm').style.display='none'" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button> 
            </form> 
        </div>

        <!-- Edit Record Modal -->
        <div id="editForm" class="modal hidden fixed inset-0 bg-gray-700 bg-opacity-50 flex justify-center items-center">
            <form action="" method="POST" class="bg-white p-6 rounded" id="editRecordForm">
                @csrf
                @method('PUT')
                <h3 class="text-xl font-semibold mb-4">Edit Derogatory Record</h3>

                <!-- Fields for Student Information -->
                <label for="edit_student_number" class="block font-medium">Student Number:</label>
                <input type="text" id="edit_student_number" name="student_number" class="w-full p-2 border rounded mb-4">

                <label for="edit_last_name" class="block font-medium">Last Name:</label>
                <input type="text" id="edit_last_name" name="last_name" class="w-full p-2 border rounded mb-4">

                <label for="edit_first_name" class="block font-medium">First Name:</label>
                <input type="text" id="edit_first_name" name="first_name" class="w-full p-2 border rounded mb-4">

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
                    <!-- Add other options as needed -->
                </select>

                <!-- Submit and Cancel Buttons -->
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Record</button>
                <button type="button" onclick="document.getElementById('editForm').style.display='none'" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
            </form>
        </div>
    </main>

    <script>
        // Function to filter the table rows
        function filterTable() {
            const input = document.getElementById("searchInput");
            const filter = input.value.toUpperCase();
            const table = document.getElementById("studentsTable");
            const rows = table.getElementsByTagName("tr");

            for (let i = 1; i < rows.length; i++) {
                const cells = rows[i].getElementsByTagName("td");
                const studentNumber = cells[0].textContent || cells[0].innerText;
                const lastName = cells[1].textContent || cells[1].innerText;
                const firstName = cells[2].textContent || cells[2].innerText;

                if (studentNumber.toUpperCase().indexOf(filter) > -1 || lastName.toUpperCase().indexOf(filter) > -1 || firstName.toUpperCase().indexOf(filter) > -1) {
                    rows[i].style.display = "";
                } else {
                    rows[i].style.display = "none";
                }
            }
        }

        // Function to edit a specific record

        function editRecord(id) {
            const record = @json($derogatoryRecords).find(record => record.id === id);
            if (record) {
                document.getElementById('edit_student_number').value = record.student_number;
                document.getElementById('edit_last_name').value = record.last_name;
                document.getElementById('edit_first_name').value = record.first_name;
                document.getElementById('edit_middle_name').value = record.middle_name;
                document.getElementById('edit_year_graduated').value = record.year_graduated;
                document.getElementById('edit_violation').value = record.violation;
                document.getElementById('edit_action_taken').value = record.action_taken;
                document.getElementById('edit_settled').value = record.settled;
                document.getElementById('edit_sanction').value = record.sanction;

                // Set the form action URL for editing
                document.getElementById('editRecordForm').action = `/derogatory_records/${id}`;

                // Display the modal
                document.getElementById('editForm').style.display = 'block';
            }
        }
    </script>
</x-app-layout>