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

                <!-- Derogatory Records Section -->
                <section class="mt-6">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Derogatory Records') }}</h3>
                    @if($records->isEmpty())
                        <p class="text-gray-500 text-lg">{{ __('No derogatory records found for this student.') }}</p>
                    @else
                        <ul class="space-y-6">
                            @foreach($records as $record)
                                <li class="bg-white dark:bg-gray-700 p-6 rounded-md shadow-md">
                                    <div class="flex justify-between items-center">
                                        <div class="text-lg">
                                            <p><strong class="text-blue-600 dark:text-blue-400">Violation:</strong> {{ $record->violation }}</p>
                                            <p><strong class="text-blue-600 dark:text-blue-400">Action Taken:</strong> {{ $record->action_taken }}</p>
                                            <p><strong class="text-blue-600 dark:text-blue-400">Sanction:</strong> {{ $record->sanction ?? 'N/A' }}</p>
                                            <p><strong class="text-blue-600 dark:text-blue-400">Settled:</strong> {{ $record->settled ? 'Yes' : 'No' }}</p>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>

                        <!-- Single View Button for All Complaints -->
                        <div class="mt-4">
                            <button type="button" 
                                    onclick="openModal({{ json_encode($complaints) }})"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                                View ({{ count($complaints) }})
                            </button>
                        </div>

                    @endif
                </section>  

                <section class="mt-8">
                    <a href="{{ route('complaints.create', ['student_id_number' => $student->student_id_number]) }}" class="w-full py-3 px-4 bg-green-600 text-white font-bold rounded-lg hover:bg-green-700 transition">
                        Add a New Complaint
                    </a>

                <!-- Add New Record Form -->
                <section class="mt-8">
                    <h3 class="text-xl font-bold text-gray-800 dark:text-white mb-4">{{ __('Add a New Derogatory Record') }}</h3>
                    <form action="{{ route('derogatory_records.update', $record->id) }}" method="POST" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Violation Input -->
                        <div>
                            <label for="violation" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Violation</label>
                            <input type="text" id="violation" name="violation" value="{{ old('violation', $record->violation) }}" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                        </div>

                        <!-- Action Taken Input -->
                        <div>
                            <label for="action_taken" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Action Taken</label>
                            <input type="text" id="action_taken" name="action_taken" value="{{ old('action_taken', $record->action_taken) }}" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                        </div>

                        <!-- Sanction Input -->
                        <div>
                            <label for="sanction" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Sanction</label>
                            <select id="sanction" name="sanction" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                <option value="suspension" {{ old('sanction', $record->sanction) == 'suspension' ? 'selected' : '' }}>Suspension</option>
                                <option value="expulsion" {{ old('sanction', $record->sanction) == 'expulsion' ? 'selected' : '' }}>Expulsion</option>
                                <option value="verbal_warning" {{ old('sanction', $record->sanction) == 'verbal_warning' ? 'selected' : '' }}>Verbal Warning</option>
                                <option value="written_warning" {{ old('sanction', $record->sanction) == 'written_warning' ? 'selected' : '' }}>Written Warning</option>
                                <option value="others" {{ old('sanction', $record->sanction) == 'others' ? 'selected' : '' }}>Others</option>
                            </select>
                        </div>

                        <!-- Settled Dropdown -->
                        <div>
                            <label for="settled" class="block text-sm font-medium text-gray-800 dark:text-gray-300">Settled</label>
                            <select id="settled" name="settled" class="mt-2 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                                <option value="1" {{ old('settled', $record->settled) == 1 ? 'selected' : '' }}>Yes</option>
                                <option value="0" {{ old('settled', $record->settled) == 0 ? 'selected' : '' }}>No</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="w-full py-3 px-4 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transition">Update Record</button>
                        </div>
                    </form>
                </section>
            </div>
        </div>
    </div>
    <!-- Modal for Viewing Complaint Details -->
    <div id="complaintModal" 
         style="display:none;" 
         class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50">
        <div class="bg-white rounded-lg p-6 max-w-md mx-auto">
            <h2 id="modalTitle" class="text-xl font-bold mb-4"></h2>
            <div id="modalContent"></div> <!-- Changed from p to div for multiline content -->
            <button onclick="closeModal()" 
                    class="mt-4 bg-red-500 text-white px-4 py-2 rounded">Close</button>
        </div>
    </div>

    <!-- JavaScript for Modal Handling -->
    <script>
        function openModal(records) {
            let content = '';
            records.forEach(record => {
                content += `
                    <strong>Complainant Name:</strong> ${record.complainant_name}<br />
                    <strong>Complainant Contact:</strong> ${record.complainant_contact}<br />
                    <strong>Incident Date:</strong> ${record.incident_date}<br />
                    <strong>Complaint Details:</strong> ${record.complaint_details}<br /><br />
                `;
            });
            document.getElementById('modalTitle').innerText = `Complaint Details`;
            document.getElementById('modalContent').innerHTML = content; // Use innerHTML for multiline content
            document.getElementById('complaintModal').style.display = 'flex';
        }

        function closeModal() {
            document.getElementById('complaintModal').style.display = 'none';
        }
    // Listen for form submission
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(event) {
        const formData = new FormData(form);
        
        // Log all form data to the console before submission
        console.log('Form Data:', Object.fromEntries(formData.entries()));
        
        // Optionally prevent form submission for debugging purposes
        // event.preventDefault();
    });
</script>

</x-app-layout>
