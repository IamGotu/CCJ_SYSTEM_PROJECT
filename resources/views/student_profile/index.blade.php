<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Profiles') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <a href="{{ route('students.create') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Add Student</a>
            
            <div class="flex items-center mt-4">
                <!-- Search Form -->
                <form method="GET" action="{{ route('students.index') }}" class="flex space-x-2">
                    <input type="text" name="search" placeholder="Search by name or ID" 
                           class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200"
                           value="{{ request('search') }}">
                    
                    <!-- Year Level Filter -->
                    <select name="year_level" class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200">
                        <option value="">Filter by Year Level</option>
                        <option value="1ST" {{ request('year_level') == '1ST' ? 'selected' : '' }}>1ST</option>
                        <option value="2ND" {{ request('year_level') == '2ND' ? 'selected' : '' }}>2ND</option>
                        <option value="3RD" {{ request('year_level') == '3RD' ? 'selected' : '' }}>3RD</option>
                        <option value="4TH" {{ request('year_level') == '4TH' ? 'selected' : '' }}>4TH</option>
                        <option value="GRADUATE" {{ request('year_level') == 'GRADUATE' ? 'selected' : '' }}>GRADUATE</option>
                    </select>
                    
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">Search</button>
                </form>

                <!-- Refresh Button -->
                <a href="{{ route('students.index') }}" class="ml-2 bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200">Refresh</a>
            </div>
            
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <!-- Adding overflow-x-auto for horizontal scroll on small screens -->
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white dark:bg-gray-700">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-200 uppercase text-xs leading-normal">
                                    <th class="py-2 px-4 text-center">Student ID Number</th>
                                    <th class="py-2 px-4 text-center">Name</th>
                                    <th class="py-2 px-4 text-center">Birthdate</th>
                                    <th class="py-2 px-4 text-center">Address</th>
                                    <th class="py-2 px-4 text-center">Contact Number</th>
                                    <th class="py-2 px-4 text-center">Guardian</th>
                                    <th class="py-2 px-4 text-center">Guardian Contact</th>
                                    <th class="py-2 px-4 text-center">Year Level</th>
                                    <th class="py-2 px-4 text-center">Graduation Date</th>
                                    <th class="py-2 px-4 text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                                @foreach ($students as $student)
                                    <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                        <td class="py-2 px-4 text-center">{{ $student->student_id_number }}</td>
                                        <td class="py-2 px-4 text-center">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}</td>
                                        <td class="py-2 px-4 text-center">{{ $student->birthdate->format('Y-m-d') }}</td>
                                        <td class="py-2 px-4 text-center">{{ $student->purok }} {{ $student->street_num }} {{ $student->street_name }} {{ $student->barangay }} {{ $student->city }} {{ $student->state }}</td>
                                        <td class="py-2 px-4 text-center">{{ $student->contact_number ?? 'N/A' }}</td>

                                        <!-- Guardian Name Logic -->
                                        <td class="py-2 px-4 text-center">
                                            {{ implode(' and ', array_filter([$student->father_name, $student->mother_name])) ?: $student->guardian_name }}
                                        </td>

                                        <!-- Guardian Contact Logic -->
                                        <td class="py-2 px-4 text-center">
                                            {{ implode(' and ', array_filter([$student->father_contact, $student->mother_contact])) ?: $student->guardian_contact }}
                                        </td>

                                        <!-- Year Level -->
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
                                @endforeach
                            </tbody>
                        </table>
                    </div> <!-- End overflow-x-auto -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>