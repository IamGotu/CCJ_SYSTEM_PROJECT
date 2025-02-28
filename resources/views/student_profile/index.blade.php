<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Profiles') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">

                <div class="flex items-center space-x-2">
                    <!-- Import Students Button -->
                    <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                        @csrf
                        <input type="file" name="file" required class="p-1 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200" style="width: 220px;">
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200 ml-2">
                            Import Students
                        </button>
                    </form>
                </div>

                <!-- Search Form and Filter Container -->
                <div class="flex flex-col sm:flex-row sm:space-x-4 items-center w-full sm:w-1/2 ">

                    <!-- Search Input for Real-Time Search -->
                    <div class="flex space-x-2 w-full sm:w-3/4 lg:w-3/4">
                        <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search by Student Number or Name"
                            class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                    </div>

                    <!-- Year Level Filter Dropdown -->
                    <form method="GET" action="{{ route('students.index') }}" class="flex w-full sm:w-auto mt-2 sm:mt-0">
                        <select name="year_level" class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-auto" id="yearLevelSelect" onchange="this.form.submit()">
                            <option value="">All Year Level</option>
                            <option value="1ST" {{ request('year_level') == '1ST' ? 'selected' : '' }}>1ST</option>
                            <option value="2ND" {{ request('year_level') == '2ND' ? 'selected' : '' }}>2ND</option>
                            <option value="3RD" {{ request('year_level') == '3RD' ? 'selected' : '' }}>3RD</option>
                            <option value="4TH" {{ request('year_level') == '4TH' ? 'selected' : '' }}>4TH</option>
                            <option value="GRADUATE" {{ request('year_level') == 'GRADUATE' ? 'selected' : '' }}>GRADUATE</option>
                        </select>
                    </form>

                    <!-- Refresh Button -->
                    <a href="{{ route('students.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 w-full sm:w-auto mt-2 sm:mt-0">
                        Refresh
                    </a>
                </div>
            </div>
        </div>

        <!-- Adding overflow-x-auto for horizontal scroll on small screens -->
        <div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-5">
            <table id="studentsTable" class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 text-xs font-medium uppercase tracking-wider">
                    <tr>
                        <th class="py-6 px-4 text-center">Student ID Number</th>
                        <th class="py-6 px-4 text-center">Name</th>
                        <th class="py-6 px-4 text-center">Contact Number</th>
                        <th class="py-6 px-4 text-center">Enrollement Status</th>
                        <th class="py-6 px-4 text-center">School Year</th>
                        <th class="py-6 px-4 text-center">Year Level</th>
                        <th class="py-6 px-4 text-center">Graduation Date</th>
                        <th class="py-6 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody id="studentsTableBody" class="text-gray-600 dark:text-gray-400 text-sm font-light">
                    @forelse ($students as $student)
                        <tr onclick="window.location='{{ route('students.show', $student->id) }}'" class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                            <td class="py-6 px-4 text-center">{{ $student->student_id_number }}</td>
                            <td class="py-6 px-4 text-center">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}</td>
                            <td class="py-6 px-4 text-center">{{ $student->contact_number ?? 'N/A' }}</td>
                            <td class="py-6 px-4 text-center">{{ $student->enrollment_status }}</td>
                            <td class="py-6 px-4 text-center">{{ $student->school_year }}</td>
                            <td class="py-2 px-4 text-center">{{ $student->year_level }}</td>
                            <td class="py-2 px-4 text-center">{{ $student->graduation_date ? $student->graduation_date->format('Y-m-d') : 'N/A' }}</td>
                            <td class="py-2 px-4 text-center">
                                <a href="{{ route('students.edit', $student) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                <form action="{{ route('students.destroy', $student) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">
                                No records found
                            </td>
                        </tr>
                    @endforelse

                    <!-- No results found message inside the table -->
                    <tr id="noResults" class="hidden">
                        <td colspan="8" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">No results found</td>
                    </tr>
                </tbody>
            </table>
        </div> <!-- End overflow-x-auto -->
    </div>

    <script>
        // Real-Time Search and Filter Functionality
        function filterTable() {
            const query = document.getElementById('searchInput').value.toLowerCase(); // Get the search query
            const yearLevel = document.getElementById('yearLevelSelect').value.toLowerCase(); // Get the selected year level
            const rows = document.querySelectorAll('#studentsTableBody tr'); // Get all rows of the table body
            const noResultsMessage = document.getElementById('noResults'); // Get the 'No results found' row
            let noResultsFound = true;

            rows.forEach(row => {
                // Skip the 'No results found' row itself to avoid hiding it prematurely
                if (row.id === 'noResults') return;

                const cells = row.getElementsByTagName('td'); // Get cells of the row
                let matchFound = false;
                let yearMatch = false;

                // Loop through each cell in the row to check if it matches the search query
                for (let i = 0; i < cells.length; i++) {
                    if (cells[i].textContent.toLowerCase().includes(query)) {
                        matchFound = true;
                        break;
                    }
                }

                // Check for Year Level filter match (if any year level is selected)
                if (yearLevel && !row.querySelector('td:nth-child(6)').textContent.toLowerCase().includes(yearLevel)) {
                    yearMatch = false;
                } else {
                    yearMatch = true;
                }

                // Show or hide the row based on whether both search and year level match
                if (matchFound && yearMatch) {
                    row.style.display = ''; // Show row
                    noResultsFound = false;
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });

            // Show or hide the 'No results found' message
            if (noResultsFound) {
                noResultsMessage.classList.remove('hidden');
            } else {
                noResultsMessage.classList.add('hidden');
            }
        }
    </script>
</x-app-layout>