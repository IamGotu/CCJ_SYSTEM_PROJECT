<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('OJT Records') }}
        </h2>
    </x-slot>

            <!-- Display Success Message -->
            @if(session('success'))
                <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Error Message -->
            @if(session('error'))
                <div id="error-message" class="bg-red-500 text-white p-4 rounded-md mb-4">
                    {{ session('error') }}
                </div>
            @endif

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">

            <!-- Secondary Navigation -->
            <nav class="flex space-x-4 mb-4">
                <a href="{{ route('ojt_records.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('ojt_records.index') ? 'text-blue-600' : '' }}">OJT Records</a>
                <a href="{{ route('coordinators.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('coordinators.index') ? 'text-blue-600' : '' }}">Coordinators</a>
                <a href="{{ route('agencies.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('agencies.index') ? 'text-blue-600' : '' }}">Agency</a>
            </nav>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                <div class="flex items-center space-x-2">

                <!-- Search and Filter Section -->
                <div class="flex items-center space-x-2">
                    <!-- Search Form -->
                    <form method="GET" action="{{ route('ojt_records.index') }}" class="flex items-center space-x-2">
                        <input type="text" name="search" placeholder="Search by name or student no."
                            class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-60"
                            value="{{ request('search') }}">

                        <select 
                            name="school_year" 
                            class="px-4 py-2 rounded-md dark:bg-gray-700"
                        >
                            <option value="" {{ request('school_year') == '' ? 'selected' : '' }}>All School Years</option>
                            <option value="2024-2025" {{ request('school_year') == '2024-2025' ? 'selected' : '' }}>2024-2025</option>
                            <option value="2023-2024" {{ request('school_year') == '2023-2024' ? 'selected' : '' }}>2023-2024</option>
                            <option value="2022-2023" {{ request('school_year') == '2022-2023' ? 'selected' : '' }}>2022-2023</option>
                            <option value="2021-2022" {{ request('school_year') == '2021-2022' ? 'selected' : '' }}>2021-2022</option>
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
                        <th class="py-6 px-4 text-center">Roster Number</th> <!-- Added column for Roster Number -->
                        <th class="py-6 px-4 text-center">Student Number</th>
                        <th class="py-6 px-4 text-center">Name</th>
                        <th class="py-6 px-4 text-center">Agency Assigned</th>
                        <th class="py-6 px-4 text-center">Credit Hours Earned</th>
                        <th class="py-6 px-4 text-center">Year Level</th>
                        <th class="py-6 px-4 text-center">School Year</th> <!-- Added column for School Year -->
                        <th class="py-6 px-4 text-center">Coordinator Assigned</th>
                        <th class="py-6 px-4 text-center">Action</th>
                    </tr>
                </thead>
                <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                    @if($ojtRecords->isEmpty())
                        <tr>
                            <td colspan="9" class="py-4 text-center text-gray-500 dark:text-gray-300">No records found</td> <!-- Updated colspan to 9 -->
                        </tr>
                    @else
                        @foreach ($ojtRecords as $record)
                            <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                <td class="py-6 px-4 text-center">{{ $record->roster_number ?? 'Not Assigned' }}</td> <!-- Added Roster Number -->
                                <td class="py-6 px-4 text-center">{{ $record->student_number }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->name }}</td>
                                <td class="py-6 px-4 text-center">
                                    {{ $record->agency ? $record->agency->name : 'Not Assigned' }}
                                </td>
                                <td class="py-6 px-4 text-center">{{ $record->credit_hours }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->year_level }}</td>
                                <td class="py-6 px-4 text-center">{{ $record->school_year ?? 'Not Assigned' }}</td> <!-- Display School Year -->
                                <td class="py-6 px-4 text-center">
                                    {{ $record->coordinator ? $record->coordinator->name : 'Not Assigned' }}
                                </td>

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

            <!-- Pagination -->
            <div class="mt-4">
                {{ $ojtRecords->links() }}
            </div>
        </div>
    </div>

<script>
    setTimeout(function() {
        const successMessage = document.getElementById('success-message');
        const errorMessage = document.getElementById('error-message');

        if (successMessage) {
            successMessage.style.display = 'none';
        }

        if (errorMessage) {
            errorMessage.style.display = 'none';
        }
    }, 3000); // 3000 milliseconds = 3 seconds
</script>
</x-app-layout>