<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900 dark:text-white leading-tight">
            {{ __('Derogatory Record Details for Student: ') }}
        </h2>
        <h3 class="text-xl font-semibold text-blue-600 dark:text-blue-300">{{ $student->first_name }} {{ $student->last_name }}</h3>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-50 dark:bg-gray-800 shadow sm:rounded-lg p-8">

                <!-- Student Information Section -->
                <section class="mb-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Student Information') }}</h3>
                    <ul class="space-y-3 text-gray-900 dark:text-gray-300">
                        <li><span class="font-semibold">Student ID Number:</span> {{ $student->student_id_number }}</li>
                        <li><span class="font-semibold">Full Name:</span> {{ $student->first_name }} {{ $student->last_name }}</li>
                        <li><span class="font-semibold">Year Level:</span> {{ $student->year_level ?? 'N/A' }}</li>
                        <li><span class="font-semibold">School Year:</span> {{ $student->school_year }}</li>
                    </ul>
                </section>

             <!-- History Records Section -->
             <section class="mt-6">
    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Derogatory Records') }}</h3>
    @if($historyRecords->isEmpty())
        <p class="text-gray-500 text-lg">{{ __('No derogatory records found for this student.') }}</p>
    @else
        <ul class="space-y-6">
            @foreach($historyRecords as $record)
                <li class="bg-white dark:bg-gray-700 p-6 rounded-md shadow-md">
                    <div class="flex justify-between items-center">
                        <div class="text-lg">
                            <p><strong class="text-blue-600 dark:text-blue-400">Violation:</strong> {{ $record->violation->violation_name }}</p>
                            <p><strong class="text-blue-600 dark:text-blue-400">Action Taken:</strong> {{ $record->action_taken }}</p>
                            <p><strong class="text-blue-600 dark:text-blue-400">Penalty:</strong> {{ $record->penalty ?? 'N/A' }}</p>
                            <p><strong class="text-blue-600 dark:text-blue-400">Settled:</strong> {{ $record->settled ? 'Yes' : 'No' }}</p>                     
                        </div>
                        <div>
                            <button 
                                class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition" 
                                onclick="openModal({{ $record->id }})">
                                Edit
                            </button>
                        </div>
                    </div>                             
                </li>
            @endforeach
        </ul>                        
    @endif
</section>

<!-- Edit Modal -->
<div id="editModal" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg w-1/3">
        <h2 class="text-lg font-bold mb-4">{{ __('Edit Derogatory Record') }}</h2>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')

            <!-- Violation -->
            <div class="mb-4">
                <label for="violation" class="block text-gray-700 dark:text-gray-300">{{ __('Violation:') }}</label>
                <input type="text" id="violation" name="violation" class="w-full p-2 border rounded" readonly>
            </div>

            <!-- Action Taken -->
            <div class="mb-4">
                <label for="action_taken" class="block text-gray-700 dark:text-gray-300">{{ __('Action Taken:') }}</label>
                <input type="text" id="action_taken" name="action_taken" class="w-full p-2 border rounded" required>
            </div>

            <!-- Penalty -->
            <div class="mb-4">
                <label for="penalty" class="block text-gray-700 dark:text-gray-300">{{ __('Penalty:') }}</label>
                <input type="text" id="penalty" name="penalty" class="w-full p-2 border rounded" readonly>
            </div>

            <!-- Settled -->
            <div class="mb-4">
                <label for="settled" class="block text-gray-700 dark:text-gray-300">{{ __('Settled:') }}</label>
                <select id="settled" name="settled" class="w-full p-2 border rounded">
                    <option value="1">{{ __('Yes') }}</option>
                    <option value="0">{{ __('No') }}</option>
                </select>
            </div>

            <!-- Buttons -->
            <div class="flex justify-end space-x-4">
                <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition" onclick="closeModal()">Cancel</button>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Update</button>
            </div>
        </form>
    </div>
</div>

                <!-- Single View Button for All Complaints -->
                <div class="mt-4">
                            <button type="button" 
                                    onclick="openViewModal({{ json_encode($complaints) }})"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                View ({{ count($complaints) }})
                            </button>
                        </div>
                        <div id="complaintModal"  style="display:none;" class="hidden fixed inset-0 z-50 flex items-center justify-center bg-gray-800 bg-opacity-75">
    <div class="bg-white dark:bg-gray-900 p-6 rounded-lg shadow-lg w-2/3">
        <!-- Modal Title -->
        <div class="flex justify-between items-center mb-4">
            <h2 id="modalTitle" class="text-lg font-bold text-gray-900 dark:text-gray-100">Complaint Details</h2>
        </div>

        <!-- Modal Content -->
        <div id="modalContent" class="text-gray-800 dark:text-gray-300">
            <!-- Dynamic content will be inserted here by JavaScript -->
        </div>

        <!-- Close Button -->
        <div class="mt-6 text-right">
            <button type="button" 
                    onclick="closeViewModal()" 
                    class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-700 transition">
                Close
            </button>
        </div>
    </div>
</div>

                <section class="mt-8">
                    <a href="{{ route('complaints.create', ['student_id_number' => $student->student_id_number]) }}" class="w-full py-3 px-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition">
                        Add a New Complaint
                    </a>
                    
                    @php
    $record = $records->first(); // Define the $record variable
@endphp
                <!-- Add New Record Form -->
                <section class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Add a New Derogatory Record') }}</h3>
                    <form action="{{ route('derogatory_records.update', $record->id) }}" method="POST" class="space-y-6" id="derogatoryRecordForm">
    @csrf
    @if(isset($record)) 
        @method('PUT') 
    @endif

    <!-- Violation Select -->
<!-- Radio Buttons to Choose Violation Type -->
<div class="form-group">
    <label class="block text-sm font-medium text-gray-800 dark:text-gray-300">Violation Type</label>
    <div class="flex items-center">
        <input type="radio" id="major" name="violation_type" value="Major" onclick="toggleViolationType('Major')" required>
        <label for="major" class="ml-2">Major</label>
    </div>
    <div class="flex items-center">
        <input type="radio" id="minor" name="violation_type" value="Minor" onclick="toggleViolationType('Minor')" required>
        <label for="minor" class="ml-2">Minor</label>
    </div>
</div>

<!-- Dropdown for Major Violations -->
<div class="form-group" id="major_violation_dropdown" style="display: none;">
    <label for="major_violation" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Major Violation</label>
    <select id="major_violation" name="violation_id">
        <option value="">-- Select Major Violation --</option>
        @foreach ($violations->where('violation_type', 'major') as $violation)
            <option value="{{ $violation->id }}">{{ $violation->violation_name }}</option>
        @endforeach
    </select>
</div>

<!-- Dropdown for Minor Violations -->
<div class="form-group" id="minor_violation_dropdown" style="display: none;">
    <label for="minor_violation" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Minor Violation</label>
    <select id="minor_violation" name="violation_id">
        <option value="">-- Select Minor Violation --</option>
        @foreach ($violations->where('violation_type', 'minor') as $violation)
            <option value="{{ $violation->id }}">{{ $violation->violation_name }}</option>
        @endforeach
    </select>
</div>


    <!-- Action Taken Input -->
    <div>
        <label for="action_taken" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Action Taken</label>
        <input type="text" id="action_taken" name="action_taken" value="{{ old('action_taken', isset($record) ? $record->action_taken : '') }}" 
               class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" 
               required>
    </div>

    <!-- Penalty Input -->
    <div class="form-group">
        <label for="penalty" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Penalty</label>
        <input type="text" id="penalty" name="penalty" 
               value="{{ old('penalty', isset($record) ? $record->penalty : '') }}" 
               class="mt-2 block w-full px-4 py-2 border rounded-md bg-gray-100 shadow-sm dark:bg-gray-700 dark:text-white dark:border-gray-600" 
               readonly>
    </div>

    <!-- Settled Dropdown -->
    <div>
        <label for="settled" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Settled</label>
        <select id="settled" name="settled" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
            <option value="1" {{ old('settled', isset($record) ? $record->settled : '') == 1 ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('settled', isset($record) ? $record->settled : '') == 0 ? 'selected' : '' }}>No</option>
        </select>
    </div>

    <!-- Student ID Hidden Field (passed with the form data) -->
    <input type="hidden" name="student_id_number" value="{{ isset($record) ? $record->student->student_id_number : '' }}">

    <!-- Submit Button -->
    <div>
        <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">Save Record</button>
    </div>
</form>
<!-- Modal for Viewing Complaint Details -->

<script src="{{ asset('js/records.js') }}" defer></script>
</x-app-layout> 

<script>
    const records = @json($historyRecords->keyBy('id'));
</script>