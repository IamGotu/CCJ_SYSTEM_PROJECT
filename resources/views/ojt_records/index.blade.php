<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('OJT Records') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <!-- Secondary Navigation -->
            <nav class="flex space-x-4 mb-4">
                <a href="{{ route('ojt_records.index') }}" class="text-gray-700 hover:text-blue-600">OJT Records</a>
                <a href="{{ route('coordinators.index') }}" class="text-gray-700 hover:text-blue-600">Coordinators</a>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                <div class="flex items-center space-x-2">
                    <!-- Add OJT Record Button -->
                    <a href="{{ route('ojt_records.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                        Add OJT Record
                    </a>
                </div>

                <!-- Search and Filter Section -->
                <div class="flex items-center space-x-2">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('ojt_records.index') }}" class="flex items-center space-x-2">
                        <input type="text" name="search" placeholder="Search by name or student no."
                               class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-60"
                               value="{{ request('search') }}">

                        <select name="year_level" class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Filter by Year Level</option>
                            <option value="1ST" {{ request('year_level') == '1ST' ? 'selected' : '' }}>1ST</option>
                            <option value="2ND" {{ request('year_level') == '2ND' ? 'selected' : '' }}>2ND</option>
                            <option value="3RD" {{ request('year_level') == '3RD' ? 'selected' : '' }}>3RD</option>
                            <option value="4TH" {{ request('year_level') == '4TH' ? 'selected' : '' }}>4TH</option>
                            <option value="GRADUATE" {{ request('year_level') == 'GRADUATE' ? 'selected' : '' }}>GRADUATE</option>
                        </select>

                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                            Search
                        </button>
                    </form>

                    <!-- Refresh Button -->
                    <a href="{{ route('ojt_records.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200">
                        Refresh
                    </a>
                </div>
            </div>
        </div>

        <div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-5">
            <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 text-xs font-medium uppercase tracking-wider">
                    <tr>
                        <th class="py-6 px-4 text-center">Student Number</th>
                        <th class="py-6 px-4 text-center">Name</th>
                        <th class="py-6 px-4 text-center">Agency Assigned</th>
                        <th class="py-6 px-4 text-center">Credit Hours Earned</th>
                        <th class="py-6 px-4 text-center">Year Level</th>
                        <th class="py-6 px-4 text-center">Coordinator Assigned</th>
                        <th class="py-6 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                    @if($ojtRecords->isEmpty())
                        <tr>
                            <td colspan="7" class="py-4 text-center text-gray-500 dark:text-gray-300">No records found</td>
                        </tr>
                    @else
                        @foreach ($ojtRecords as $record)
                            <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                <td class="py-6 px-4 text-center">{{ $record->student_number }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->name }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->agency_assigned }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->credit_hours }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->year_level }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->coordinator->name ?? 'N/A' }}</td>
                                <td class="py-6 px-4 text-center">
                                    <a href="{{ route('ojt_records.edit', $record) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    <form action="{{ route('ojt_records.destroy', $record) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-500 hover:text-red-700 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>