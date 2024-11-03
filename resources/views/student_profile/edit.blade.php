<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('students.update', $student->id) }}">
                        @csrf
                        @method('PUT')

                        @foreach ([
                            'student_id_number' => 'Student ID Number',
                            'first_name' => 'First Name',
                            'middle_name' => 'Middle Name',
                            'last_name' => 'Last Name',
                            'suffix' => 'Suffix',
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
                                <input type="{{ in_array($name, ['birthdate', 'graduation_date']) ? 'date' : 'text' }}"
                                       name="{{ $name }}"
                                       class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                                       id="{{ $name }}"
                                       value="{{ old($name, $name == 'birthdate' && $student->birthdate ? $student->birthdate->format('Y-m-d') : $student->$name) }}"
                                       @if(in_array($name, ['student_id_number', 'first_name', 'last_name', 'birthdate'])) required @endif>
                            </div>
                        @endforeach

                        <div class="mb-4">
                            <label for="graduated" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Graduated</label>
                            <select name="graduated" required
                                    class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                                <option value="1" {{ $student->graduated ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$student->graduated ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label for="graduation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Graduation Date</label>
                            <input type="date" name="graduation_date" value="{{ old('graduation_date', $student->graduation_date ? $student->graduation_date->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>