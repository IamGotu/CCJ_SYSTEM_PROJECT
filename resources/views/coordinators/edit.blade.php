<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Coordinator') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('coordinators.update', $coordinator) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <!-- Name -->
                    <div class="mb-4">
                        <label for="name" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Coordinator Name</label>
                        <input type="text" name="name" id="name" class="form-input w-full" value="{{ old('name', $coordinator->name) }}" required>
                        @error('name')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Contact -->
                    <div class="mb-4">
                        <label for="contact" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Contact</label>
                        <input type="text" name="contact" id="contact" class="form-input w-full" value="{{ old('contact', $coordinator->contact) }}" required>
                        @error('contact')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div class="mb-4">
                        <label for="email" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Email</label>
                        <input type="email" name="email" id="email" class="form-input w-full" value="{{ old('email', $coordinator->email) }}" required>
                        @error('email')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Address -->
                    <div class="mb-4">
                        <label for="address" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Address</label>
                        <input type="text" name="address" id="address" class="form-input w-full" value="{{ old('address', $coordinator->address) }}" required>
                        @error('address')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Username -->
                    <div class="mb-4">
                        <label for="username" class="block font-medium text-sm text-gray-700 dark:text-gray-300">Username</label>
                        <input type="text" name="username" id="username" class="form-input w-full" value="{{ old('username', $coordinator->username) }}" required>
                        @error('username')
                            <span class="text-red-500 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-6">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded">
                            Update Coordinator
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
