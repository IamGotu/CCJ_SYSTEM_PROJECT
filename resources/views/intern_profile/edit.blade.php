<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Student') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('intern.update', ['intern' => $intern->id]) }}">
                        @csrf
                        @method('PUT')

                        <!-- Display only fields -->
                        <div class="mb-4">
                            <p><strong>Student Number:</strong> {{ $intern->student_number }}</p>
                            <p><strong>Name:</strong> {{ $intern->first_name }} {{ $intern->middle_name }} {{ $intern->last_name }}</p>
                            <p><strong>Year Level:</strong> {{ $intern->year_level }}</p>
                        </div>

                        <!-- Roster Number -->
                        <div class="mb-4">
                            <label for="roster_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                Roster Number
                            </label>
                            <input type="text" 
                                   name="roster_number" 
                                   id="roster_number" 
                                   value="{{ old('roster_number', $intern->roster_number) }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 dark:bg-gray-700 shadow-sm">
                        </div>

                        <!-- Documents -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Documents Submitted
                            </label>
                            <div class="space-y-2">
                                @php
                                    $documentsList = [
                                        'Barangay Certificate',
                                        'Personal Data Sheet',
                                        'Court Clearance',
                                        'Medical Certificate'
                                    ];
                                    $currentDocs = isset($currentDocuments) ? $currentDocuments : [];
                                @endphp

                                @foreach($documentsList as $doc)
                                    <div>
                                        <label class="inline-flex items-center">
                                            <input type="checkbox" 
                                                   name="documents[]" 
                                                   value="{{ $doc }}"
                                                   {{ in_array($doc, $currentDocs) ? 'checked' : '' }}
                                                   class="rounded border-gray-300 dark:border-gray-600 text-indigo-600 shadow-sm">
                                            <span class="ml-2">{{ $doc }}</span>
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center gap-4">
                            <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                UPDATE
                            </button>
                            <a href="{{ route('intern.profile') }}" class="px-4 py-2 bg-gray-500 text-white rounded hover:bg-gray-600">
                                CANCEL
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 