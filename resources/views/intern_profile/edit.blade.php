<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-900 py-8 px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Main Container -->
            <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
                <!-- Header Section -->
                <div class="bg-gray-700 p-6 border-b border-gray-600">
                    <h1 class="text-2xl font-bold text-white">Edit Student Profile</h1>
                </div>

                <!-- Content Section -->
                <div class="p-6 space-y-6">
                    <!-- Student Info -->
                    <div class="grid grid-cols-2 gap-6 text-gray-300">
                        <div>
                            <label class="block text-sm text-gray-400">Student Number</label>
                            <p class="text-lg font-semibold">{{ $intern->student_number }}</p>
                        </div>
                        <div>
                            <label class="block text-sm text-gray-400">Name</label>
                            <p class="text-lg font-semibold">{{ $intern->first_name }} {{ $intern->middle_name }} {{ $intern->last_name }}</p>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('intern.update', $intern->student_number) }}" class="space-y-6">
                        @csrf
                        @method('PUT')

                        <!-- Year Level -->
                        <div class="bg-gray-700/50 rounded-lg p-4">
                            <label class="block text-sm text-gray-400">Year Level</label>
                            <p class="text-lg font-semibold text-white">{{ $intern->year_level }}</p>
                        </div>

                        <!-- Batch & CIBAT Info -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="batch_name" class="block text-sm font-medium text-gray-400 mb-1">
                                    Batch Name/Year
                                </label>
                                <input type="text"
                                       id="batch_name"
                                       name="batch_name"
                                       value="{{ old('batch_name', $intern->batch_name ?? '') }}"
                                       placeholder="e.g., Batch 2023-A"
                                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all">
                            </div>

                            <div>
                                <label for="cibat_class" class="block text-sm font-medium text-gray-400 mb-1">
                                    CIBAT Class
                                </label>
                                <input type="text"
                                       id="cibat_class"
                                       name="cibat_class"
                                       value="{{ old('cibat_class', $intern->cibat_class ?? '') }}"
                                       placeholder="e.g., Class A"
                                       class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all">
                            </div>
                        </div>

                        <!-- Roster Number -->
                        <div>
                            <label for="roster_number" class="block text-sm font-medium text-gray-400 mb-1">
                                Roster Number
                            </label>
                            <input type="text"
                                   id="roster_number"
                                   name="roster_number"
                                   value="{{ old('roster_number', $intern->roster_number ?? '') }}"
                                   class="w-full px-4 py-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all">
                        </div>

                        <!-- Documents Section -->
                        <div class="bg-gray-700/50 rounded-lg p-6">
                            <h3 class="text-lg font-semibold text-white mb-4">Documents Submitted</h3>
                            
                            @php
                                $currentDocs = isset($currentDocuments) ? $currentDocuments : [];
                            @endphp

                            <div class="space-y-3">
                                <label class="flex items-center space-x-3 text-gray-300">
                                    <input type="checkbox"
                                           name="documents[]"
                                           value="Barangay Certificate"
                                           {{ in_array('Barangay Certificate', $currentDocs) ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                    <span>Barangay Certificate</span>
                                </label>

                                <label class="flex items-center space-x-3 text-gray-300">
                                    <input type="checkbox"
                                           name="documents[]"
                                           value="Personal Data Sheet"
                                           {{ in_array('Personal Data Sheet', $currentDocs) ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                    <span>Personal Data Sheet</span>
                                </label>

                                <label class="flex items-center space-x-3 text-gray-300">
                                    <input type="checkbox"
                                           name="documents[]"
                                           value="Court Clearance"
                                           {{ in_array('Court Clearance', $currentDocs) ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                    <span>Court Clearance</span>
                                </label>

                                <label class="flex items-center space-x-3 text-gray-300">
                                    <input type="checkbox"
                                           name="documents[]"
                                           value="Medical Certificate"
                                           {{ in_array('Medical Certificate', $currentDocs) ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                    <span>Medical Certificate</span>
                                </label>

                                <label class="flex items-center space-x-3 text-gray-300">
                                    <input type="checkbox"
                                           name="documents[]"
                                           value="Psychological/Neuro Test"
                                           {{ in_array('Psychological/Neuro Test', $currentDocs) ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                    <span>Psychological/Neuro Test</span>
                                </label>

                                <label class="flex items-center space-x-3 text-gray-300">
                                    <input type="checkbox"
                                           name="documents[]"
                                           value="Drug Test"
                                           {{ in_array('Drug Test', $currentDocs) ? 'checked' : '' }}
                                           class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                    <span>Drug Test</span>
                                </label>

                                <div class="space-y-2">
                                    <label class="flex items-center space-x-3 text-gray-300">
                                        <input type="checkbox"
                                               id="others"
                                               name="documents[]"
                                               value=""
                                               class="w-5 h-5 rounded border-gray-600 text-blue-500 focus:ring-blue-500 focus:ring-offset-gray-700">
                                        <span>Others</span>
                                    </label>
                                    <input type="text"
                                           id="othersText"
                                           placeholder="Specify other documents"
                                           class="hidden w-full px-4 py-2 mt-2 bg-gray-700 border border-gray-600 rounded-lg text-white placeholder-gray-400 focus:border-blue-500 focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50 transition-all">
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="flex justify-end space-x-4 pt-6 border-t border-gray-700">
                            <a href="{{ route('intern.index') }}"
                               class="px-6 py-2 bg-gray-700 text-gray-300 rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 transition-all">
                                Cancel
                            </a>
                            <button type="submit"
                                    class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
    document.getElementById('others').addEventListener('change', function() {
        const othersText = document.getElementById('othersText');
        othersText.style.display = this.checked ? 'block' : 'none';
        if (this.checked) {
            othersText.addEventListener('input', function() {
                document.getElementById('others').value = this.value;
            });
        } else {
            this.value = '';
            othersText.value = '';
        }
    });
    </script>
</x-app-layout> 