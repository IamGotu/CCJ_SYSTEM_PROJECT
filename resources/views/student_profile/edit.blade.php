<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('students.update', $student->id) }}">
                        @csrf
                        @method('PUT')

                        <!-- Student ID Number -->
                        <div class="mb-4">
                            <label for="student_id_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student ID Number</label>
                            <input type="text" name="student_id_number" id="student_id_number" required
                                   value="{{ old('student_id_number', $student->student_id_number) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Name Fields -->
                        <div class="mb-4">
                            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <input type="text" name="first_name" id="first_name" required
                                   value="{{ old('first_name', $student->first_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="middle_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name"
                                   value="{{ old('middle_name', $student->middle_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <input type="text" name="last_name" id="last_name" required
                                   value="{{ old('last_name', $student->last_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="suffix" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Suffix</label>
                            <input type="text" name="suffix" id="suffix"
                                   value="{{ old('suffix', $student->suffix) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Birthdate -->
                        <div class="mb-4">
                            <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birthdate</label>
                            <input type="date" name="birthdate" id="birthdate" required
                                   value="{{ old('birthdate', $student->birthdate ? $student->birthdate->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Purok -->
                        <div class="mb-4">
                            <label for="purok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purok</label>
                            <input type="text" name="purok" id="purok"
                                   value="{{ old('purok', $student->purok) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Address Fields -->
                        <div class="mb-4">
                            <label for="street_num" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street Number</label>
                            <input type="text" name="street_num" id="street_num"
                                   value="{{ old('street_num', $student->street_num) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="street_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street Name</label>
                            <input type="text" name="street_name" id="street_name"
                                   value="{{ old('street_name', $student->street_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="barangay" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barangay</label>
                            <input type="text" name="barangay" id="barangay"
                                   value="{{ old('barangay', $student->barangay) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                            <input type="text" name="city" id="city"
                                   value="{{ old('city', $student->city) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                            <input type="text" name="state" id="state"
                                   value="{{ old('state', $student->state) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="postal_num" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Postal Number</label>
                            <input type="text" name="postal_num" id="postal_num"
                                   value="{{ old('postal_num', $student->postal_num) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Contact Number -->
                        <div class="mb-4">
                            <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                            <input type="text" name="contact_number" id="contact_number"
                                   value="{{ old('contact_number', $student->contact_number) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Guardian Details -->
                        <div class="mb-4">
                            <label for="father_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Father Name</label>
                            <input type="text" name="father_name" id="father_name"
                                   value="{{ old('father_name', $student->father_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="mother_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mother Name</label>
                            <input type="text" name="mother_name" id="mother_name"
                                   value="{{ old('mother_name', $student->mother_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="guardian_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guardian Name</label>
                            <input type="text" name="guardian_name" id="guardian_name"
                                   value="{{ old('guardian_name', $student->guardian_name) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="father_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Father Contact</label>
                            <input type="text" name="father_contact" id="father_contact"
                                   value="{{ old('father_contact', $student->father_contact) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="mother_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mother Contact</label>
                            <input type="text" name="mother_contact" id="mother_contact"
                                   value="{{ old('mother_contact', $student->mother_contact) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <div class="mb-4">
                            <label for="guardian_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guardian Contact</label>
                            <input type="text" name="guardian_contact" id="guardian_contact"
                                   value="{{ old('guardian_contact', $student->guardian_contact) }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Enrollment Status -->
                        <div class="mb-4">
                            <label for="enrollment_status" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Enrollment Status</label>
                            <select name="enrollment_status" required
                                    class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled>Select Enrollment Status</option>
                                <option value="Enrolled" {{ old('enrollment_status', $student->enrollment_status) === 'Enrolled' ? 'selected' : '' }}>Enrolled</option>
                                <option value="Not Enrolled" {{ old('enrollment_status', $student->enrollment_status) === 'Not Enrolled' ? 'selected' : '' }}>Not Enrolled</option>
                                <option value="GRADUATE" {{ old('enrollment_status', $student->enrollment_status) === 'GRADUATE' ? 'selected' : '' }}>GRADUATE</option>
                            </select>
                        </div>

                        <!-- School Year -->
                        <div class="mb-4">
                            <label for="school_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">School Year</label>
                            <input type="text" name="school_year" id="school_year"
                                   value="{{ old('school_year', $student->school_year) }}"
                                    class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <!-- Year Level -->
                        <div class="mb-4">
                            <label for="year_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Year Level</label>
                            <select name="year_level" required
                                    class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                                <option value="" disabled>Select Year Level</option>
                                <option value="1ST" {{ old('year_level', $student->year_level) === '1ST' ? 'selected' : '' }}>1ST</option>
                                <option value="2ND" {{ old('year_level', $student->year_level) === '2ND' ? 'selected' : '' }}>2ND</option>
                                <option value="3RD" {{ old('year_level', $student->year_level) === '3RD' ? 'selected' : '' }}>3RD</option>
                                <option value="4TH" {{ old('year_level', $student->year_level) === '4TH' ? 'selected' : '' }}>4TH</option>
                                <option value="GRADUATE" {{ old('year_level', $student->year_level) === 'GRADUATE' ? 'selected' : '' }}>GRADUATE</option>
                            </select>
                        </div>

                        <!-- Graduation Date -->
                        <div class="mb-4">
                            <label for="graduation_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Graduation Date</label>
                            <input type="date" name="graduation_date"
                                   value="{{ old('graduation_date', $student->graduation_date ? $student->graduation_date->format('Y-m-d') : '') }}"
                                   class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>

                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>