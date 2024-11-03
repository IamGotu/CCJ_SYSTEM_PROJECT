<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Student') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('students.store') }}">
                        @csrf

                        @foreach ([
                            'student_id_number' => 'Student ID Number',
                            'first_name' => 'First Name',
                            'middle_name' => 'Middle Name',
                            'last_name' => 'Last Name',
                            'suffix' => 'Suffix',  // Suffix is optional
                            'birthdate' => 'Birthdate',
                            'purok' => 'Purok',
                            'street_num' => 'Street Number',
                            'street_name' => 'Street Name',
                            'barangay' => 'Barangay',
                            'city' => 'City',
                            'state' => 'State',
                            'postal_num' => 'Postal Number',
                            'contact_number' => 'Contact Number',
                            'father_name' => 'Father Name',
                            'mother_name' => 'Mother Name',
                            'guardian_name' => 'Guardian Name',
                            'father_contact' => 'Father Contact',
                            'mother_contact' => 'Mother Contact',
                            'guardian_contact' => 'Guardian Contact',
                        ] as $name => $label)
                            <div class="mb-4">
                                <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
                                <input type="{{ in_array($name, ['birthdate']) ? 'date' : 'text' }}"
                                       name="{{ $name }}"
                                       class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                                       id="{{ $name }}"
                                       @if(in_array($name, ['student_id_number', 'first_name', 'last_name', 'birthdate'])) required @endif>
                            </div>
                        @endforeach

                        <div class="mb-4">
                            <label for="year_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year Level</label>
                            <select name="year_level" required
                                    class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled selected>Select Year Level</option>
                                <option value="1ST">1ST</option>
                                <option value="2ND">2ND</option>
                                <option value="3RD">3RD</option>
                                <option value="4TH">4TH</option>
                                <option value="GRADUATE">GRADUATE</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="graduation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Graduation Date</label>
                            <input type="date" name="graduation_date"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Add Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>