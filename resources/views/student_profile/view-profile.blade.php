<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ $student->first_name }} {{ $student->last_name }} - Profile
        </h2>
    </x-slot>
    <div class="py-4">
        <!-- Display the student's details here -->
    </div>
</x-app-layout>