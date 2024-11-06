<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#1E293B] overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form method="POST" action="{{ route('intern.update', $intern->id) }}" class="space-y-6">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            <!-- Last Name -->
                            <div>
                                <x-input-label for="last_name" :value="__('Last Name')" class="text-white" />
                                <x-text-input id="last_name" name="last_name" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('last_name', $intern->last_name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('last_name')" />
                            </div>

                            <!-- First Name -->
                            <div>
                                <x-input-label for="first_name" :value="__('First Name')" class="text-white" />
                                <x-text-input id="first_name" name="first_name" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('first_name', $intern->first_name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('first_name')" />
                            </div>

                            <!-- Middle Name -->
                            <div>
                                <x-input-label for="middle_name" :value="__('Middle Name (Optional)')" class="text-white" />
                                <x-text-input id="middle_name" name="middle_name" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    value="{{ old('middle_name', $intern->middle_name) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('middle_name')" />
                            </div>

                            <!-- Student Number -->
                            <div>
                                <x-input-label for="student_number" :value="__('Student Number')" class="text-white" />
                                <x-text-input id="student_number" name="student_number" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('student_number', $intern->student_number) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('student_number')" />
                            </div>

                            <!-- Age -->
                            <div>
                                <x-input-label for="age" :value="__('Age')" class="text-white" />
                                <x-text-input id="age" name="age" type="number" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('age', $intern->age) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('age')" />
                            </div>

                            <!-- Address -->
                            <div>
                                <x-input-label for="address" :value="__('Address')" class="text-white" />
                                <x-text-input id="address" name="address" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('address', $intern->address) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('address')" />
                            </div>

                            <!-- Guardian -->
                            <div>
                                <x-input-label for="guardian" :value="__('Guardian')" class="text-white" />
                                <x-text-input id="guardian" name="guardian" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('guardian', $intern->guardian) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('guardian')" />
                            </div>

                            <!-- Guardian Contact -->
                            <div>
                                <x-input-label for="guardian_contact" :value="__('Guardian Contact')" class="text-white" />
                                <x-text-input id="guardian_contact" name="guardian_contact" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('guardian_contact', $intern->guardian_contact) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('guardian_contact')" />
                            </div>

                            <!-- Roster Number -->
                            <div>
                                <x-input-label for="roster_number" :value="__('Roster Number')" class="text-white" />
                                <x-text-input id="roster_number" name="roster_number" type="text" 
                                    class="mt-1 block w-full bg-gray-700 text-white border-gray-600" 
                                    required value="{{ old('roster_number', $intern->roster_number) }}" />
                                <x-input-error class="mt-2" :messages="$errors->get('roster_number')" />
                            </div>
                        </div>

                        <!-- Documents Submitted -->
                        <div>
                            <x-input-label :value="__('Documents Submitted')" class="text-white mb-2" />
                            <div class="space-y-2">
                                @php
                                    $documents = is_array($intern->documents) ? $intern->documents : [];
                                @endphp
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Barangay Certificate" 
                                        {{ in_array('Barangay Certificate', $documents) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Barangay Certificate</span>
                                </label>
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Personal Data Sheet" 
                                        {{ in_array('Personal Data Sheet', $documents) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Personal Data Sheet</span>
                                </label>
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Court Clearance" 
                                        {{ in_array('Court Clearance', $documents) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Court Clearance</span>
                                </label>
                                <label class="flex items-center text-white">
                                    <input type="checkbox" name="documents[]" value="Medical Certificate" 
                                        {{ in_array('Medical Certificate', $documents) ? 'checked' : '' }}
                                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                                    <span class="ml-2">Medical Certificate</span>
                                </label>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Update') }}</x-primary-button>
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