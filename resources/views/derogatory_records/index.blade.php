<!-- resources/views/derogatory_records/index.blade.php -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Derogatory Records') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-full mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white dark:bg-gray-800">
                    <h3 class="text-lg font-semibold text-gray-800 dark:text-gray-200 mb-4">
                        List of Derogatory Records
                    </h3>
                    <!-- Display your records here -->
                    @foreach($records as $record)
                        <p>{{ $record->detail }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
