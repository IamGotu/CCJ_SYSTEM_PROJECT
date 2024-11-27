<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Students Derogatory Records') }}
        </h2>
    </x-slot>

    <!-- Main container -->
    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <!-- Row with search bar and add new record button -->
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                <!-- Button to Add New Record -->
                <a href="{{ route('derogatory_records.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200 w-full sm:w-auto">
                    Add New Record
                </a>

                <!-- Search bar -->
                <div class="flex space-x-2 w-full sm:w-1/2 lg:w-1/3">
                    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search by student initials or student number..."
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>
        </div>

        <!-- Table container with overflow-x-auto for responsiveness -->
        <div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-5 w-full sm:w-auto">
            <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 text-xs font-medium uppercase tracking-wider">
                    <tr>
                        <th class="px-6 py-4 text-left">Student Number</th>
                        <th class="px-6 py-4 text-left">Last Name</th>
                        <th class="px-6 py-4 text-left">First Name</th>
                        <th class="px-6 py-4 text-left">Middle Name</th>
                        <th class="px-6 py-4 text-left">Year Graduated</th>
                        <th class="px-6 py-4 text-left">Violation</th>
                        <th class="px-6 py-4 text-left">Action Taken</th>
                        <th class="px-6 py-4 text-left">Settled</th>
                        <th class="px-6 py-4 text-left">Sanction</th>
                        <th class="px-6 py-4 text-left">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @if($derogatoryRecords->isEmpty())
                        <tr>
                            <td colspan="10" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">No records found</td>
                        </tr>
                    @else
                        @foreach ($derogatoryRecords as $record)
                            <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-300">
                                <td class="px-6 py-4">{{ $record->student_number }}</td>
                                <td class="px-6 py-4">{{ $record->last_name }}</td>
                                <td class="px-6 py-4">{{ $record->first_name }}</td>
                                <td class="px-6 py-4">{{ $record->middle_name }}</td>
                                <td class="px-6 py-4">{{ $record->year_graduated }}</td>
                                <td class="px-6 py-4">{{ $record->violation }}</td>
                                <td class="px-6 py-4">{{ $record->action_taken }}</td>
                                <td class="px-6 py-4">{{ $record->settled }}</td>
                                <td class="px-6 py-4">{{ $record->sanction }}</td>
                                <td class="px-6 py-4 flex space-x-2 justify-start">
                                    <a href="{{ route('derogatory_records.show', $record->id) }}" class="text-blue-500 hover:text-blue-600 transition duration-200">View</a> |
                                    <button onclick="editRecord({{ $record->id }})" class="text-yellow-500 hover:text-yellow-600 transition duration-200">Edit</button> |
                                    <form action="{{ route('derogatory_records.destroy', $record->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-600 transition duration-200" onclick="return confirm('Are you sure?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>

    <!-- Scripts -->
    <script>
        // JavaScript for search bar functionality (filtering the table)
        function filterTable() {
            const input = document.getElementById('searchInput');
            const filter = input.value.toUpperCase();
            const table = document.querySelector('table');
            const tr = table.getElementsByTagName('tr');
            
            for (let i = 0; i < tr.length; i++) {
                const td = tr[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < td.length; j++) {
                    if (td[j] && td[j].innerText.toUpperCase().indexOf(filter) > -1) {
                        found = true;
                        break;
                    }
                }
                tr[i].style.display = found ? '' : 'none';
            }
        }
    </script>
</x-app-layout>