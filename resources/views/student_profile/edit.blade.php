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
                        <div>
                            <label for="student_id_number">Student ID Number</label>
                            <input type="text" name="student_id_number" value="{{ $student->student_id_number }}" required>
                        </div>
                        <div>
                            <label for="first_name">First Name</label>
                            <input type="text" name="first_name" value="{{ $student->first_name }}" required>
                        </div>
                        <div>
                            <label for="middle_name">Middle Name</label>
                            <input type="text" name="middle_name" value="{{ $student->middle_name }}">
                        </div>
                        <div>
                            <label for="last_name">Last Name</label>
                            <input type="text" name="last_name" value="{{ $student->last_name }}" required>
                        </div>
                        <div>
                            <label for="suffix">Suffix</label>
                            <input type="text" name="suffix" value="{{ $student->suffix }}">
                        </div>
                        <div>
                            <label for="birthdate">Birthdate</label>
                            <input type="date" name="birthdate" value="{{ $student->birthdate }}" required>
                        </div>
                        <div>
                            <label for="purok">Purok</label>
                            <input type="text" name="purok" value="{{ $student->purok }}">
                        </div>
                        <div>
                            <label for="street_num">Street Number</label>
                            <input type="text" name="street_num" value="{{ $student->street_num }}">
                        </div>
                        <div>
                            <label for="street_name">Street Name</label>
                            <input type="text" name="street_name" value="{{ $student->street_name }}">
                        </div>
                        <div>
                            <label for="barangay">Barangay</label>
                            <input type="text" name="barangay" value="{{ $student->barangay }}">
                        </div>
                        <div>
                            <label for="city">City</label>
                            <input type="text" name="city" value="{{ $student->city }}">
                        </div>
                        <div>
                            <label for="state">State</label>
                            <input type="text" name="state" value="{{ $student->state }}">
                        </div>
                        <div>
                            <label for="postal_num">Postal Number</label>
                            <input type="text" name="postal_num" value="{{ $student->postal_num }}">
                        </div>
                        <div>
                            <label for="contact_number">Contact Number</label>
                            <input type="text" name="contact_number" value="{{ $student->contact_number }}">
                        </div>
                        <div>
                            <label for="guardian_name">Guardian Name</label>
                            <input type="text" name="guardian_name" value="{{ $student->guardian_name }}">
                        </div>
                        <div>
                            <label for="graduated">Graduated</label>
                            <select name="graduated" required>
                                <option value="1" {{ $student->graduated ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ !$student->graduated ? 'selected' : '' }}>No</option>
                            </select>
                        </div>
                        <div>
                            <label for="graduation_date">Graduation Date</label>
                            <input type="date" name="graduation_date" value="{{ $student->graduation_date }}">
                        </div>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update Student</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>