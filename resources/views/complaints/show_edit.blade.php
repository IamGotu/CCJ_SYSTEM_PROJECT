<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $mode === 'edit' ? 'Edit Complaint' : 'Complaint Details' }}
        </h2>
    </x-slot>

    <div class="py-12">
    <div class="max-w-7xl mx-auto sm:flex sm:items-center">
        <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-6 bg-white dark:bg-gray-800">
                @if(session('success'))
                    <div class="bg-green-100 text-green-800 p-4 rounded-lg shadow mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if($mode === 'view')
                    <div class="space-y-4 text-lg text-gray-800 dark:text-gray-200">
                        <p><strong class="text-blue-600">Complainant Name:</strong> {{ $complaint->complainant_name }}</p>
                        <p><strong class="text-blue-600">Complainant Position:</strong> {{ $complaint->complainant_position }}</p>
                        <p><strong class="text-blue-600">Complainant Contact:</strong> {{ $complaint->complainant_contact }}</p>
                        <p><strong class="text-blue-600">Complainant Email:</strong> {{ $complaint->complainant_email }}</p>
                        <p><strong class="text-blue-600">Complainant Type:</strong>{{ ucfirst($complaint->complainant_type) }}@if($complaint->complainant_type === 'student') <span class="text-gray-600"> (Student ID: {{ $complaint->complainant_student_id }})</span>  @endif</p>
                        <p><strong class="text-blue-600">Incident Date:</strong> {{ $complaint->incident_date }}</p>
                        <p><strong class="text-blue-600">Incident Time:</strong> {{ $complaint->incident_time }}</p>
                        <p><strong class="text-blue-600">Incident Location:</strong> {{ $complaint->incident_location }}</p>
                        <p><strong class="text-blue-600">Violation Type:</strong> {{ $complaint->violation_type }}</p>
                        <p><strong class="text-blue-600">Minor Offense:</strong> {{ $complaint->minor_offense ? 'Yes' : 'No' }}</p>
                        <p><strong class="text-blue-600">Major Offense:</strong> {{ $complaint->major_offense ? 'Yes' : 'No' }}</p>
                        <p><strong class="text-blue-600">Complaint Details:</strong> {{ $complaint->complaint_details }}</p>
                        <p><strong class="text-blue-600">Previous Incidents:</strong> {{ $complaint->previous_incidents }}</p>
                        <p><strong class="text-blue-600">Action Taken:</strong> {{ $complaint->action_taken }}</p>
                        <p><strong class="text-blue-600">Requested Action:</strong> {{ $complaint->requested_action }}</p>
                    </div>

                    @if ($complaint->evidence_files)
                        <div class="mt-6">
                            <strong class="text-blue-600">Evidence Files:</strong>
                            <ul class="list-disc pl-6 space-y-2">
                                @foreach (json_decode($complaint->evidence_files, true) as $file)
                                    <li class="flex items-center">
                                        @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                                            <img src="{{ route('evidence.file', basename($file)) }}" alt="Evidence Image" class="max-w-full h-auto rounded-lg shadow-md">
                                        @else
                                            <a href="{{ route('evidence.file', basename($file)) }}" target="_blank" class="text-blue-500 hover:text-blue-700 underline">
                                                {{ basename($file) }}
                                            </a>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="mt-8 flex gap-4">
                        <a href="{{ route('complaints.showOrEdit', ['id' => $complaint->id, 'mode' => 'edit']) }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow hover:bg-blue-600 transition duration-300 ease-in-out">
                            Edit
                        </a>
                        <form action="{{ route('complaints.destroy', $complaint->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-6 py-3 rounded-lg shadow hover:bg-red-600 transition duration-300 ease-in-out">
                                Delete
                            </button>
                        </form>
                    </div>
                    @elseif($mode === 'edit')
                    <form action="{{ route('complaints.update', $complaint->id) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label for="complainant_name" class="block text-gray-700">Complainant Name</label>
        <input type="text" id="complainant_name" name="complainant_name" value="{{ $complaint->complainant_name }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="complainant_position" class="block text-gray-700">Complainant Position</label>
        <input type="text" id="complainant_position" name="complainant_position" value="{{ $complaint->complainant_position }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="complainant_contact" class="block text-gray-700">Complainant Contact</label>
        <input type="text" id="complainant_contact" name="complainant_contact" value="{{ $complaint->complainant_contact }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="complainant_email" class="block text-gray-700">Complainant Email</label>
        <input type="email" id="complainant_email" name="complainant_email" value="{{ $complaint->complainant_email }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
    <label for="complainant_type" class="block text-gray-700">Complainant Type</label>
    <select id="complainant_type" name="complainant_type" class="w-full border-gray-300 rounded" required>
        <option value="student" {{ $complaint->complainant_type == 'student' ? 'selected' : '' }}>Student</option>
        <option value="faculty" {{ $complaint->complainant_type == 'faculty' ? 'selected' : '' }}>Faculty</option>
        <option value="staff" {{ $complaint->complainant_type == 'staff' ? 'selected' : '' }}>Staff</option>
    </select>
</div>

<div id="complainant_student_id_container" class="mb-4" style="display: {{ $complaint->complainant_type == 'student' ? 'block' : 'none' }};">
    <label for="complainant_student_id" class="block text-gray-700">Student ID</label>
    <input 
        type="text" 
        id="complainant_student_id" 
        name="complainant_student_id" 
        class="w-full border-gray-300 rounded" 
        value="{{ $complaint->complainant_student_id ?? '' }}">
</div>

    <div class="mb-4">
        <label for="incident_date" class="block text-gray-700">Incident Date</label>
        <input type="date" id="incident_date" name="incident_date" value="{{ $complaint->incident_date }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="incident_time" class="block text-gray-700">Incident Time</label>
        <input type="time" id="incident_time" name="incident_time" value="{{ $complaint->incident_time }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="incident_location" class="block text-gray-700">Incident Location</label>
        <input type="text" id="incident_location" name="incident_location" value="{{ $complaint->incident_location }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="violation_type" class="block text-gray-700">Violation Type</label>
        <input type="text" id="violation_type" name="violation_type" value="{{ $complaint->violation_type }}" class="w-full border-gray-300 rounded" required>
    </div>

    <div class="mb-4">
        <label for="minor_offense" class="block text-gray-700">Minor Offense</label>
        <input type="checkbox" id="minor_offense" name="minor_offense" value="1" {{ $complaint->minor_offense ? 'checked' : '' }}>
    </div>

    <div class="mb-4">
        <label for="major_offense" class="block text-gray-700">Major Offense</label>
        <input type="checkbox" id="major_offense" name="major_offense" value="1" {{ $complaint->major_offense ? 'checked' : '' }}>
    </div>

    <div class="mb-4">
        <label for="complaint_details" class="block text-gray-700">Complaint Details</label>
        <textarea id="complaint_details" name="complaint_details" rows="4" class="w-full border-gray-300 rounded" required>{{ $complaint->complaint_details }}</textarea>
    </div>

    <div class="mb-4">
        <label for="previous_incidents" class="block text-gray-700">Previous Incidents</label>
        <textarea id="previous_incidents" name="previous_incidents" rows="4" class="w-full border-gray-300 rounded">{{ $complaint->previous_incidents }}</textarea>
    </div>

         <!-- Action Taken Dropdown -->
         <div class="mb-4">
                                <label for="action_taken" class="block text-sm font-medium text-gray-800 dark:text-gray-300">{{ __('Action Taken') }}</label>
                                <select name="action_taken" id="action_taken" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                    <option value="" disabled selected>Select action taken</option>
                                    <option value="pending" {{ $complaint->action_taken == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="resolved" {{ $complaint->action_taken == 'resolved' ? 'selected' : '' }}>Resolved</option>
                                    <option value="other" {{ $complaint->action_taken == 'other' ? 'selected' : '' }}>Other</option>
                                </select>
                                @error('action_taken')<small class="text-red-500">{{ $message }}</small>@enderror
                            </div>
    <div class="mb-4">
        <label for="requested_action" class="block text-gray-700">Requested Action</label>
        <textarea id="requested_action" name="requested_action" rows="4" class="w-full border-gray-300 rounded">{{ $complaint->requested_action }}</textarea>
    </div>

    <div class="mb-4">
        <label for="evidence_files" class="block text-gray-700">Evidence Files</label>
        <input type="file" id="evidence_files" name="evidence_files[]" multiple class="w-full border-gray-300 rounded">
        
        @if ($complaint->evidence_files)
            <p class="mt-2 text-sm text-gray-600">Current Files:</p>
            <ul>
                @foreach (json_decode($complaint->evidence_files, true) as $file)
                    <li>
                        @if (in_array(pathinfo($file, PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png']))
                            <img src="{{ route('evidence.file', basename($file)) }}" 
                                 alt="Evidence Image" 
                                 class="max-w-full h-auto rounded mb-4">
                        @else
                            <a href="{{ route('evidence.file', ['filename' => basename($file)]) }}" 
                               target="_blank" 
                               class="text-blue-500 hover:underline">
                                {{ basename($file) }}
                            </a>
                        @endif
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="mt-4 flex gap-2">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Save Changes
        </button>
        <a href="{{ route('complaints.showOrEdit', ['id' => $complaint->id, 'mode' => 'view']) }}" 
           class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
            Cancel
        </a>
    </div>
</form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
