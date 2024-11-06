<!-- resources/views/derogatory_records/create.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Derogatory Record') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <!-- Form for adding a new derogatory record -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-4">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('derogatory_records.store') }}" method="POST">
                        @csrf
                        
                        <!-- Student Number -->
                        <div class="mb-4">
                            <label for="student_number" class="block font-medium">Student Number:</label>
                            <input type="text" id="student_number" name="student_number" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Last Name -->
                        <div class="mb-4">
                            <label for="last_name" class="block font-medium">Last Name:</label>
                            <input type="text" id="last_name" name="last_name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- First Name -->
                        <div class="mb-4">
                            <label for="first_name" class="block font-medium">First Name:</label>
                            <input type="text" id="first_name" name="first_name" class="w-full p-2 border border-gray-300 rounded-lg" required>
                        </div>

                        <!-- Middle Name -->
                        <div class="mb-4">
                            <label for="middle_name" class="block font-medium">Middle Name:</label>
                            <input type="text" id="middle_name" name="middle_name" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Year Graduated -->
                        <div class="mb-4">
                            <label for="year_graduated" class="block font-medium">Year Graduated:</label>
                            <input type="number" id="year_graduated" name="year_graduated" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Violation -->
                        <div class="mb-4">
                            <label for="violation" class="block font-medium">Violation:</label>
                            <input type="text" id="violation" name="violation" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Action Taken -->
                        <div class="mb-4">
                            <label for="action_taken" class="block font-medium">Action Taken:</label>
                            <input type="text" id="action_taken" name="action_taken" class="w-full p-2 border border-gray-300 rounded-lg">
                        </div>

                        <!-- Settled -->
                        <div class="mb-4">
                            <label for="settled" class="block font-medium">Settled:</label>
                            <select id="settled" name="settled" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="">Select...</option>
                                <option value="yes">Yes</option>
                                <option value="no">No</option>
                            </select>
                        </div>

                        <!-- Sanction -->
                        <div class="mb-4">
                            <label for="sanction" class="block font-medium">Sanction:</label>
                            <select id="sanction" name="sanction" class="w-full p-2 border border-gray-300 rounded-lg">
                                <option value="">Select...</option>
                                <option value="suspension">Suspension</option>
                                <option value="expulsion">Expulsion</option>
                            </select>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-between items-center mt-4">
                            <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Add Record</button>
                            <a href="{{ route('derogatory_records.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>