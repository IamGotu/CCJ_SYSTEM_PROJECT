<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- Tab Navigation -->
    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4">
                <div class="flex border-b border-gray-200">
                    <button onclick="switchTab('students')" id="studentsTab" class="px-6 py-3 text-blue-600 border-b-2 border-blue-600">
                        Students
                    </button>
                    <button onclick="switchTab('interns')" id="internsTab" class="px-6 py-3 text-gray-600 hover:text-blue-600">
                        Interns
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Students Section -->
    <div id="studentsSection">
        <div class="py-1">
            <div class="max-w mx-auto sm:px-6 lg:px-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                    <!-- Your existing students buttons and search -->
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('students.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                            Add Student
                        </a>
                        
                        <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                            @csrf
                            <input type="file" name="file" required class="p-1 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200" style="width: 220px;">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200 ml-2">
                                Import Students
                            </button>
                        </form>
                    </div>

                    <!-- Your existing search and filter -->
                    <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                        <!-- ... existing search form ... -->
                    </div>
                </div>
            </div>

            <!-- Your existing students table -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <!-- ... existing table content ... -->
            </div>
        </div>
    </div>

    <!-- Interns Section -->
    <div id="internsSection" class="hidden">
        <div class="py-1">
            <div class="max-w mx-auto sm:px-6 lg:px-5">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                    <div class="flex items-center space-x-2">
                        <a href="{{ route('interns.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">
                            Add Intern
                        </a>
                        
                        <form action="{{ route('interns.import') }}" method="POST" enctype="multipart/form-data" class="flex items-center">
                            @csrf
                            <input type="file" name="file" required class="p-1 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200" style="width: 220px;">
                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200 ml-2">
                                Import Interns
                            </button>
                        </form>
                    </div>

                    <div class="flex flex-col sm:flex-row sm:items-center space-y-2 sm:space-y-0 sm:space-x-2 w-full sm:w-auto">
                        <form method="GET" action="{{ route('interns.index') }}" class="flex flex-col sm:flex-row sm:space-x-2 w-full sm:w-auto">
                            <input type="text" name="search" placeholder="Search by name or ID"
                                class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-60"
                                value="{{ request('search') }}">

                            <select name="school" class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-auto">
                                <option value="">Filter by School</option>
                                @foreach($schools ?? [] as $school)
                                    <option value="{{ $school }}" {{ request('school') == $school ? 'selected' : '' }}>{{ $school }}</option>
                                @endforeach
                            </select>

                            <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                                Search
                            </button>
                        </form>

                        <a href="{{ route('interns.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 sm:ml-2">
                            Refresh
                        </a>
                    </div>
                </div>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <!-- Intern table headers and content -->
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-200 uppercase text-xs leading-normal">
                                    <th class="py-2 px-4 text-center">Intern ID</th>
                                    <th class="py-2 px-4 text-center">Name</th>
                                    <th class="py-2 px-4 text-center">School</th>
                                    <th class="py-2 px-4 text-center">Course</th>
                                    <th class="py-2 px-4 text-center">Year Level</th>
                                    <th class="py-2 px-4 text-center">Start Date</th>
                                    <th class="py-2 px-4 text-center">End Date</th>
                                    <th class="py-2 px-4 text-center">Supervisor</th>
                                    <th class="py-2 px-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                                @foreach ($interns ?? [] as $intern)
                                    <!-- Intern rows -->
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for tab switching -->
    <script>
        function switchTab(tab) {
            const studentsSection = document.getElementById('studentsSection');
            const internsSection = document.getElementById('internsSection');
            const studentsTab = document.getElementById('studentsTab');
            const internsTab = document.getElementById('internsTab');

            if (tab === 'students') {
                studentsSection.classList.remove('hidden');
                internsSection.classList.add('hidden');
                studentsTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                studentsTab.classList.remove('text-gray-600');
                internsTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                internsTab.classList.add('text-gray-600');
            } else if (tab === 'interns') {
                internsSection.classList.remove('hidden');
                studentsSection.classList.add('hidden');
                internsTab.classList.add('text-blue-600', 'border-b-2', 'border-blue-600');
                internsTab.classList.remove('text-gray-600');
                studentsTab.classList.remove('text-blue-600', 'border-b-2', 'border-blue-600');
                studentsTab.classList.add('text-gray-600');
            }
        }
    </script>
</x-app-layout> 