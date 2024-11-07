<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Interns Profile') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <!-- Updated padding here for consistent alignment -->
        <div class="max-w mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mt-4 space-y-2 sm:space-y-0">
                
                <!-- Add Intern Button -->
                <div class="flex items-center space-x-2">
                    <a href="{{ route('intern.create') }}" class="px-6 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        Add Intern
                    </a>
                </div>

                <!-- Search Form -->
                <div class="flex items-center space-x-2">
                    <form method="GET" action="{{ route('intern.profile') }}" class="flex items-center">
                        <input 
                            type="text" 
                            name="search" 
                            placeholder="Search by student number" 
                            class="bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-200 placeholder-gray-500 rounded-md border-gray-300 dark:border-gray-600 p-2"
                            value="{{ request('search') }}"
                        >
                        <button type="submit" class="ml-2 px-4 py-2 bg-gray-800 dark:bg-gray-600 text-white rounded-md hover:bg-gray-700">
                            Search
                        </button>
                    </form>
                </div>
            </div>

            <!-- Table Section with matching padding -->
            <div class="overflow-x-auto mt-6">
                <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                    <thead class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 text-xs font-medium uppercase tracking-wider">
                        <tr>
                            <th class="px-6 py-3 text-left">Student Number</th>
                            <th class="px-6 py-3 text-left">Last Name</th>
                            <th class="px-6 py-3 text-left">First Name</th>
                            <th class="px-6 py-3 text-left">Middle Name</th>
                            <th class="px-6 py-3 text-left">Age</th>
                            <th class="px-6 py-3 text-left">Address</th>
                            <th class="px-6 py-3 text-left">Guardian</th>
                            <th class="px-6 py-3 text-left">Guardian Contact</th>
                            <th class="px-6 py-3 text-left">Roster Number</th>
                            <th class="px-6 py-3 text-left">Documents</th>
                            <th class="px-6 py-3 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200 dark:divide-gray-600">
                        @forelse($interns as $intern)
                            <tr>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->student_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->last_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->first_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->middle_name }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->age }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->address }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->guardian }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->guardian_contact }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">{{ $intern->roster_number }}</td>
                                <td class="px-6 py-4 text-sm text-gray-900 dark:text-gray-200">
                                    @if(is_array($intern->documents))
                                        {{ implode(', ', $intern->documents) }}
                                    @else
                                        {{ $intern->documents }}
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm font-medium text-right">
                                    <a href="{{ route('intern.edit', $intern->id) }}" class="text-green-600 hover:text-green-900 dark:text-green-400 dark:hover:text-green-300 mr-3">
                                        Edit
                                    </a>
                                    <form action="{{ route('intern.destroy', $intern->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 dark:text-red-400 dark:hover:text-red-300" onclick="return confirm('Are you sure you want to delete this record?')">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="11" class="px-6 py-4 text-center text-gray-500 dark:text-gray-400">
                                    No records found
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>