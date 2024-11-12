<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Student Profile') }}
        </h2>
    </x-slot>

    <div class="py-4">
        <div class="max-w-2xl mx-auto bg-white dark:bg-gray-800 p-6 rounded-lg shadow-md">
            <!-- Emphasized Heading Style -->
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4 border-b-2 border-gray-300 pb-1">
                Personal Information
            </h3>
            <p><strong>Student ID Number:</strong> {{ $student->student_id_number }}</p>
            <p><strong>Name:</strong> {{ $student->first_name }} {{ $student->middle_name }} {{ $student->last_name }} {{ $student->suffix }}</p>
            <p><strong>Birthdate:</strong> {{ $student->birthdate->format('Y-m-d') }}</p>
            <p><strong>Contact Number:</strong> {{ $student->contact_number ?? 'N/A' }}</p>

            <!-- Repeat Emphasized Heading Style for Other Sections -->
            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-6 mb-4 border-b-2 border-gray-300 pb-1">
                Address Information
            </h3>
            <p><strong>Purok:</strong> {{ $student->purok ?? 'N/A' }}</p>
            <p><strong>Street Number:</strong> {{ $student->street_num ?? 'N/A' }}</p>
            <p><strong>Street Name:</strong> {{ $student->street_name ?? 'N/A' }}</p>
            <p><strong>Barangay:</strong> {{ $student->barangay ?? 'N/A' }}</p>
            <p><strong>City:</strong> {{ $student->city ?? 'N/A' }}</p>
            <p><strong>State:</strong> {{ $student->state ?? 'N/A' }}</p>
            <p><strong>Postal Code:</strong> {{ $student->postal_num ?? 'N/A' }}</p>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-6 mb-4 border-b-2 border-gray-300 pb-1">
                Guardian Information
            </h3>
            <p><strong>Father's Name:</strong> {{ $student->father_name ?? 'N/A' }}</p>
            <p><strong>Father's Contact:</strong> {{ $student->father_contact ?? 'N/A' }}</p>
            <p><strong>Mother's Name:</strong> {{ $student->mother_name ?? 'N/A' }}</p>
            <p><strong>Mother's Contact:</strong> {{ $student->mother_contact ?? 'N/A' }}</p>
            <p><strong>Guardian's Name:</strong> {{ $student->guardian_name ?? 'N/A' }}</p>
            <p><strong>Guardian's Contact:</strong> {{ $student->guardian_contact ?? 'N/A' }}</p>

            <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mt-6 mb-4 border-b-2 border-gray-300 pb-1">
                Academic Information
            </h3>
            <p><strong>Year Level:</strong> {{ $student->year_level }}</p>
            <p><strong>Graduation Date:</strong> {{ $student->graduation_date ? $student->graduation_date->format('Y-m-d') : 'N/A' }}</p>
        </div>
    </div>
</x-app-layout>