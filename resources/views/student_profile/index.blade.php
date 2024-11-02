<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Profiles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <a href="{{ route('students.create') }}" class="mt-4 inline-block bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700 transition duration-200">Add Student</a>
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <table class="min-w-full bg-white dark:bg-gray-700">
                        <thead>
                            <tr class="bg-gray-100 dark:bg-gray-600 text-gray-600 dark:text-gray-200 uppercase text-xs leading-normal">
                                <th class="py-3 px-6 text-left">Student ID Number</th>
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-left">Birthdate</th>
                                <th class="py-3 px-6 text-left">Address</th>
                                <th class="py-3 px-6 text-left">Guardian</th>
                                <th class="py-3 px-6 text-left">Guardian Contact</th>
                                <th class="py-3 px-6 text-left">Graduated</th>
                                <th class="py-3 px-6 text-left">Graduation Date</th>
                                <th class="py-3 px-6 text-left">Action</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600 dark:text-gray-400 text-sm font-light">
                            @foreach ($students as $student)
                                <tr class="border-b border-gray-200 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-600 transition duration-200">
                                    <td class="py-4 px-6">{{ $student->student_id_number }}</td>
                                    <td class="py-4 px-6">{{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}</td>
                                    <td class="py-4 px-6">{{ $student->birthdate->format('Y-m-d') }}</td>
                                    <td class="py-4 px-6">{{ $student->street_num }} {{ $student->street_name }}, {{ $student->barangay }}, {{ $student->city }}</td>
                                    
                                    <!-- Guardian Name Logic -->
                                    <td class="py-4 px-6">
                                        {{ implode(' and ', array_filter([$student->father_name, $student->mother_name])) ?: $student->guardian_name }}
                                    </td>
                                    
                                    <!-- Guardian Contact Logic -->
                                    <td class="py-4 px-6">
                                        {{ implode(' and ', array_filter([$student->father_contact, $student->mother_contact])) ?: $student->guardian_contact }}
                                    </td>

                                    <td class="py-4 px-6">{{ $student->graduated ? 'Yes' : 'No' }}</td>
                                    <td class="py-4 px-6">{{ $student->graduation_date ? $student->graduation_date->format('Y-m-d') : 'N/A' }}</td>
                                    <td class="py-4 px-6">
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
                </div>
            </div>
        </div>
    </div>
</x-app-layout>