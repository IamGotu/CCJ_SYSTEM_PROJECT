<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create Agency') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <!-- Agency Form -->
            <form action="{{ route('agencies.store') }}" method="POST" class="space-y-4">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Name</label>
                    <input type="text" id="name" name="name" class="mt-1 p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full" required>
                </div>

                <!-- Address -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Address</label>
                    <textarea id="address" name="address" class="mt-1 p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full" required></textarea>
                </div>

                <!-- Contact Person -->
                <div>
                    <label for="contact_person" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Contact Person</label>
                    <input type="text" id="contact_person" name="contact_person" class="mt-1 p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full" required>
                </div>

                <!-- Contact Number -->
                <div>
                    <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Contact Number</label>
                    <input type="text" id="contact_number" name="contact_number" class="mt-1 p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full" required>
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                        Create Agency
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
