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
                <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('students.index') }}" class="flex flex-col sm:flex-row sm:space-x-2 w-full sm:w-auto">
                        <!-- Search Input -->
                        <input type="text" name="search" placeholder="Search by name or ID"
                            class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-60"
                            value="{{ request('search') }}">

                        <!-- Year Level Filter Dropdown -->
                        <select name="year_level" class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-auto">
                            <option value="">Filter by Year Level</option>
                            <option value="1ST" {{ request('year_level') == '1ST' ? 'selected' : '' }}>1ST</option>
                            <option value="2ND" {{ request('year_level') == '2ND' ? 'selected' : '' }}>2ND</option>
                            <option value="3RD" {{ request('year_level') == '3RD' ? 'selected' : '' }}>3RD</option>
                            <option value="4TH" {{ request('year_level') == '4TH' ? 'selected' : '' }}>4TH</option>
                            <option value="GRADUATE" {{ request('year_level') == 'GRADUATE' ? 'selected' : '' }}>GRADUATE</option>
                        </select>
                        <!-- Search Button -->
                        <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                            Search
                        </button>
                    </form>

                    <!-- Refresh Button -->
                    <a href="{{ route('students.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 sm:ml-2">
                        Refresh
                    </a>
                </div>
            </div>
        </div>

        <!-- Adding overflow-x-auto for horizontal scroll on small screens -->
        <div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-5">
            <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
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
                <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                    @forelse ($students as $student)
                        <tr onclick="window.location='{{ route('students.show', $student->id) }}'" class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                            <td class="py-6 px-4 text-center">{{ $student->student_id_number }}</td>
                            <td class="py-6 px-4 text-center">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}</td>
                            <td class="py-6 px-4 text-center">{{ $student->contact_number ?? 'N/A' }}</td>

                            <!-- Standing -->
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
                            <td colspan="10" class="py-4 px-6 text-center text-gray-500 dark:text-gray-400">
                                No records found
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div> <!-- End overflow-x-auto -->
    </div>
</x-app-layout>