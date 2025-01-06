<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Students Derogatory Records') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <!-- Header with Add Record Button and Search -->

                <div class="flex space-x-2 w-full sm:w-1/2 lg:w-1/3">
                    <input type="text" id="searchInput" onkeyup="filterTable()" 
                           placeholder="Search by student initials or student number..." 
                           class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
        </div>

        <!-- Records Table -->
        <div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-5 w-full sm:w-auto">
            <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 text-xs font-medium uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">Student Number</th>
                        <th class="px-6 py-4 text-left">Last Name</th>
                        <th class="px-6 py-4 text-left">First Name</th>
                        <th class="px-6 py-4 text-left">Year Level</th>
                        <th class="px-6 py-4 text-left">School Year</th>
                        <th class="px-6 py-4 text-left">Status</th>
                        <th class="px-6 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody id="recordsTableBody" class="text-gray-600 dark:text-gray-400 text-sm">
                    @forelse ($derogatoryRecords as $record)
                        <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                            <td class="px-6 py-4">{{ $record->student->student_id_number }}</td>
                            <td class="px-6 py-4">{{ $record->student->last_name }}</td>
                            <td class="px-6 py-4">{{ $record->student->first_name }}</td>
                            <td class="px-6 py-4">{{ $record->student->year_level }}</td>
                            <td class="px-6 py-4">{{ $record->student->school_year }}</td>
                            <td class="px-6 py-4">{{ $record->student->enrollment_status }}</td>
                            <td class="px-6 py-4">
                                <div class="flex space-x-2">
                                    <a href="{{ route('derogatory_records.show', $record->student->student_id_number) }}" 
                                       class="text-blue-600 hover:text-blue-800">Add Record for this student</a>
                                    <form action="{{ route('derogatory_records.destroy', $record->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="text-red-600 hover:text-red-800"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="8" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function filterTable() {
            const query = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#recordsTableBody tr');
            let hasVisibleRow = false;

            rows.forEach(row => {
                const studentNumber = row.cells[0].textContent.toLowerCase();
                const lastName = row.cells[1].textContent.toLowerCase();
                if (studentNumber.includes(query) || lastName.includes(query)) {
                    row.style.display = "";
                    hasVisibleRow = true;
                } else {
                    row.style.display = "none";
                }
            });

            const noResultsRow = document.querySelector('#noResults');
            if (noResultsRow) {
                noResultsRow.style.display = hasVisibleRow ? "none" : "";
            }
        }
    </script>
</x-app-layout>