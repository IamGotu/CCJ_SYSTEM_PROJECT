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
                <div class="py-2">
                    <a href="{{ route('derogatory_records.create') }}" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">
                        Add New Record
                    </a>
                </div>

                <!-- Search bar -->
                <div class="flex space-x-2 w-full sm:w-1/2 lg:w-1/3">
                    <input type="text" id="searchInput" onkeyup="filterTable()" placeholder="Search by student initials or student number..."
                        class="w-full p-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                </div>
            </div>

            <!-- Table container with overflow-x-auto for responsiveness -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Adding overflow-x-auto for horizontal scroll on small screens -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-200 uppercase text-xs leading-normal">
                                    <th class="px-4 py-2 text-left">Student Number</th>
                                    <th class="px-4 py-2 text-left">Last Name</th>
                                    <th class="px-4 py-2 text-left">First Name</th>
                                    <th class="px-4 py-2 text-left">Middle Name</th>
                                    <th class="px-4 py-2 text-left">Year Graduated</th>
                                    <th class="px-4 py-2 text-left">Violation</th>
                                    <th class="px-4 py-2 text-left">Action Taken</th>
                                    <th class="px-4 py-2 text-left">Settled</th>
                                    <th class="px-4 py-2 text-left">Sanction</th>
                                    <th class="px-4 py-2 text-left">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($derogatoryRecords as $record)
                                    <tr class="hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-300">
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
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
    <!-- Scripts -->
    <script>
        // JavaScript for search bar functionality and modal controls here
    </script>
</x-app-layout>