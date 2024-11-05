<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1E293B] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('intern.store') }}" class="space-y-6">
                        @csrf
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Last Name -->
                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')" class="text-white" />
                                <x-text-input id="last_name" name="last_name" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('last_name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                            </div>

                            <!-- First Name -->
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" class="text-white" />
                                <x-text-input id="first_name" name="first_name" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('first_name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" class="text-white" />
                                <x-text-input id="middle_name" name="middle_name" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    value="{{ old('middle_name') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Age -->
                            <div>
                                <x-input-label for="age" :value="__('Age')" class="text-white" />
                                <x-text-input id="age" name="age" type="number" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('age') }}" min="0" />
                                <x-input-error class="mt-2" :messages="$errors->get('age')" />
                            </div>

                            <!-- Address -->
                            <div>
                                <x-input-label for="address" :value="__('Complete Address')" class="text-white" />
                                <x-text-input id="address" name="address" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('address') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Guardian -->
                            <div>
                                <x-input-label for="guardian" :value="__('Parents Name/Guardian')" class="text-white" />
                                <x-text-input id="guardian" name="guardian" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('guardian') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('guardian')" />
                            </div>

                            <!-- Guardian Contact -->
                            <div>
                                <x-input-label for="guardian_contact" :value="__('Guardian Contact Number')" class="text-white" />
                                <x-text-input id="guardian_contact" name="guardian_contact" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('guardian_contact') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('guardian_contact')" />
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <!-- Student Number -->
                            <div>
                                <x-input-label for="student_number" :value="__('Student Number')" class="text-white" />
                                <x-text-input id="student_number" name="student_number" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('student_number') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('student_number')" />
                            </div>

                            <!-- Roster Number -->
                            <div>
                                <x-input-label for="roster_number" :value="__('Roster Number')" class="text-white" />
                                <x-text-input id="roster_number" name="roster_number" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('roster_number') }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('roster_number')" />
                            </div>
                        </div>

                        <!-- Documents Submitted -->
                        <div>
                            <x-input-label :value="__('Documents Submitted')" class="text-white mb-2" />
                            <div class="space-y-2">
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Barangay Certificate" 
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Barangay Certificate</span>
                                </label>
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Personal Data Sheet" 
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Personal Data Sheet</span>
                                </label>
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Court Clearance" 
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Court Clearance</span>
                                </label>
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Medical Certificate" 
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Medical Certificate</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Save') }}</x-primary-button>
                            <a href="{{ route('intern.profile') }}" 
                                class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 