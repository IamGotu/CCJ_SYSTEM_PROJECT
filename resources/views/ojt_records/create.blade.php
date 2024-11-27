<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add OJT Record') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('ojt_records.store') }}" method="POST">
                    @csrf
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Name</label>
                        <input type="text" name="name" id="name" class="form-input w-full" value="{{ old('name') }}" required>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Student Number -->
                    <div class="mb-4">
                        <label for="student_number" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Student Number</label>
                        <input type="text" name="student_number" id="student_number" class="form-input w-full" value="{{ old('student_number') }}" required>
                        @error('student_number')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Agency Assigned -->
                    <div class="mb-4">
                        <label for="agency_assigned" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Agency Assigned</label>
                        <input type="text" name="agency_assigned" id="agency_assigned" class="form-input w-full" value="{{ old('agency_assigned') }}" required>
                        @error('agency_assigned')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Credit Hours Earned -->
                    <div class="mb-4">
                        <label for="credit_hours" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Credit Hours Earned</label>
                        <input type="number" name="credit_hours" id="credit_hours" class="form-input w-full" value="{{ old('credit_hours') }}" required>
                        @error('credit_hours')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Year Level -->
                    <div class="mb-4">
                        <label for="year_level" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Year Level</label>
                        <select 
                            name="year_level" 
                            id="year_level" 
                            class="px-4 py-2 rounded-md dark:bg-gray-700 w-full"
                            required
                        >
                            <option value="" {{ old('year_level') == '' ? 'selected' : '' }}>Select Year Level</option>
                            <option value="4th" {{ old('year_level') == '4th' ? 'selected' : '' }}>4th Year</option>
                            <option value="Graduated" {{ old('year_level') == 'graduated' ? 'selected' : '' }}>Graduated</option>
                        </select>
                        @error('year_level')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>


                    <!-- Coordinator Assigned -->
                    <div class="mb-4">
                        <label for="coordinator_id" class="block text-sm font-medium text-gray-700">Coordinator Assigned</label>
                        <select name="coordinator_id" id="coordinator_id" class="mt-1 block w-full p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200">
                            <option value="">Select Coordinator</option>
                            @foreach($coordinators as $coordinator)
                                <option value="{{ $coordinator->id }}" {{ old('coordinator_id') == $coordinator->id ? 'selected' : '' }}>
                                    {{ $coordinator->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Submit Button -->
                    <div>
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Save Record
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
