<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
            {{ __('Create a Complaint for Student: ') }}
        </h2>
        <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-300">{{ $student->first_name }} {{ $student->last_name }}</h3>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 shadow sm:rounded-lg p-8">
            @if(session('success'))
                    <div class="bg-green-500 text-white p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Error Messages -->
                @if($errors->any())
                    <div class="bg-red-500 text-white p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Complaint Creation Form -->
                <form action="{{ route('complaints.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Hidden Student ID -->
                    <input type="hidden" name="student_id_number" value="{{ $student->student_id_number }}">
                    <!-- Student Information Section -->
                    <section class="mb-8">
                        <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Student Information') }}</h3>
                        <ul class="space-y-3 text-gray-900 dark:text-gray-300">
                            <li><span class="font-semibold">Student ID Number:</span> {{ $student->student_id_number }}</li>
                            <li><span class="font-semibold">Full Name:</span> {{ $student->first_name }} {{ $student->last_name }}</li>
                            <li><span class="font-semibold">Course/Program:</span> {{ $student->course_program ?? 'N/A' }}</li>
                            <li><span class="font-semibold">Year Level:</span> {{ $student->year_level ?? 'N/A' }}</li>
                            <li><span class="font-semibold">School Year:</span> {{ $student->school_year }}</li>
                        </ul>
                    </section>

                    <!-- Complaint Details Section -->
                    <section class="mt-6">
    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Complaint Details') }}</h3>

    <!-- Complainant Name -->
    <div class="mb-4">
        <label for="complainant_name" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complainant Name') }}</label>
        <input type="text" name="complainant_name" id="complainant_name" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('complainant_name') }}" required>
        @error('complainant_name')<small class="text-red-500">{{ $message }}</small>@enderror
    </div>

    <!-- Complainant Type -->
    <div class="mb-4">
        <label for="complainant_type" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complainant Type') }}</label>
        <div class="flex items-center space-x-4">
            <div>
                <input type="radio" name="complainant_type" id="complainant_type_student" value="student" {{ old('complainant_type') == 'student' ? 'checked' : '' }}>
                <label for="complainant_type_student" class="text-sm text-gray-800 dark:text-gray-300">{{ __('Student') }}</label>
            </div>
            <div>
                <input type="radio" name="complainant_type" id="complainant_type_civilian" value="civilian" {{ old('complainant_type') == 'civilian' ? 'checked' : '' }}>
                <label for="complainant_type_civilian" class="text-sm text-gray-800 dark:text-gray-300">{{ __('Civilian') }}</label>
            </div>
        </div>
        @error('complainant_type')<small class="text-red-500">{{ $message }}</small>@enderror
    </div>

    <!-- Complainant Student ID (Conditional) -->
    <div id="complainant_student_id" class="mb-4" style="display: {{ old('complainant_type') == 'student' ? 'block' : 'none' }}">
        <label for="complainant_student_id" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complainant Student ID') }}</label>
        <input type="text" name="complainant_student_id" id="complainant_student_id_input" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('complainant_student_id') }}" {{ old('complainant_type') == 'student' ? 'required' : '' }}>
        @error('complainant_student_id')<small class="text-red-500">{{ $message }}</small>@enderror
    </div>

                    <!-- Complainant Email -->
                    <div class="mb-4">
                        <label for="complainant_email" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complainant Email') }}</label>
                        <input type="email" name="complainant_email" id="complainant_email" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('complainant_email') }}" required>
                        @error('complainant_email')<small class="text-red-500">{{ $message }}</small>@enderror
                    </div>
                                            <!-- Complainant Position -->
                        <div class="mb-4">
                            <label for="complainant_position" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complainant Position') }}</label>
                            <input type="text" name="complainant_position" id="complainant_position" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('complainant_position') }}" required>
                            @error('complainant_position')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Complainant Contact -->
                        <div class="mb-4">
                            <label for="complainant_contact" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complainant Contact') }}</label>
                            <input type="text" name="complainant_contact" id="complainant_contact" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('complainant_contact') }}" required>
                            @error('complainant_contact')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Incident Date -->
                        <div class="mb-4">
                            <label for="incident_date" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Incident Date') }}</label>
                            <input type="date" name="incident_date" id="incident_date" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('incident_date') }}" required>
                            @error('incident_date')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Incident Time -->
                        <div class="mb-4">
                            <label for="incident_time" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Incident Time') }}</label>
                            <input type="time" name="incident_time" id="incident_time" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('incident_time') }}" required>
                            @error('incident_time')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Incident Location -->
                        <div class="mb-4">
                            <label for="incident_location" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Incident Location') }}</label>
                            <input type="text" name="incident_location" id="incident_location" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" value="{{ old('incident_location') }}" required>
                            @error('incident_location')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Complaint Details -->
                        <div class="mb-4">
                            <label for="complaint_details" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Complaint Details') }}</label>
                            <textarea name="complaint_details" id="complaint_details" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" rows="4" required>{{ old('complaint_details') }}</textarea>
                            @error('complaint_details')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Violation Type -->
                        <div class="mb-4">
                            <label for="violation_type" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Violation Type') }}</label>
                            <select name="violation_type" id="violation_type" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                <option value="academic" {{ old('violation_type') == 'academic' ? 'selected' : '' }}>Academic</option>
                                <option value="behavioral" {{ old('violation_type') == 'behavioral' ? 'selected' : '' }}>Behavioral</option>
                            </select>
                            @error('violation_type')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Minor Offense -->
                        <div class="mb-4">
                            <label for="minor_offense" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Minor Offense') }}</label>
                            <input type="checkbox" name="minor_offense" id="minor_offense" value="1" {{ old('minor_offense') ? 'checked' : '' }}>
                            @error('minor_offense')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Major Offense -->
                        <div class="mb-4">
                            <label for="major_offense" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Major Offense') }}</label>
                            <input type="checkbox" name="major_offense" id="major_offense" value="1" {{ old('major_offense') ? 'checked' : '' }}>
                            @error('major_offense')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                         <!-- Evidence Files -->
                         <div class="mb-4">
                            <label for="evidence_files" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Evidence Files (PNG, JPG, PDF)') }}</label>
                            <input type="file" name="evidence_files[]" id="evidence_files" multiple accept=".png,.jpg,.jpeg,.pdf" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                            @error('evidence_files.*')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Previous Incidents -->
                        <div class="mb-4">
                            <label for="previous_incidents" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Previous Incidents') }}</label>
                            <textarea name="previous_incidents" id="previous_incidents" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" rows="4">{{ old('previous_incidents') }}</textarea>
                            @error('previous_incidents')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                       <!-- Action Taken Dropdown -->
                       <div class="mb-4">
                            <label for="action_taken" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Action Taken') }}</label>
                            <select name="action_taken" id="action_taken" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                <option value="" disabled selected>Select action taken</option>
                                <option value="pending" {{ old('action_taken') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="resolved" {{ old('action_taken') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                <option value="other" {{ old('action_taken') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('action_taken')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <!-- Requested Action -->
                        <div class="mb-4">
                            <label for="requested_action" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Requested Action') }}</label>
                            <textarea name="requested_action" id="requested_action" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" rows="4">{{ old('requested_action') }}</textarea>
                            @error('requested_action')<small class="text-red-500">{{ $message }}</small>@enderror
                        </div>

                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-md">Submit Complaint</button>
                    </section>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const complainantTypeRadio = document.querySelectorAll('input[name="complainant_type"]');
        const complainantStudentIdDiv = document.getElementById('complainant_student_id');
        const complainantStudentIdInput = document.getElementById('complainant_student_id_input'); // Ensure you are selecting the correct input field

        // Toggle visibility based on the selected complainant type
        complainantTypeRadio.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === 'student') {
                    complainantStudentIdDiv.style.display = 'block';
                } else {
                    complainantStudentIdDiv.style.display = 'none';
                    complainantStudentIdInput.value = ''; // Clear the value if the field is hidden
                }
            });

            // Initial check when the page loads
            if (radio.checked && radio.value === 'student') {
                complainantStudentIdDiv.style.display = 'block';
            } else {
                complainantStudentIdInput.value = ''; // Ensure it's cleared when not student
            }
        });
    });
</script>
</x-app-layout>
