<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add New Coordinator') }}
        </h2>
    </x-slot>

    <div class="py-5">
        <div class="max-w mx-auto sm:px-6 lg:px-5">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('coordinators.store') }}">
                        @csrf

                        @foreach ([
                            'name' => 'Coordinator Name',
                            'contact' => 'Contact',
                            'email' => 'Email',
                            'address' => 'Address',
                            'username' => 'Username',
                        ] as $name => $label)
                            <div class="mb-4">
                                <label for="{{ $name }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">{{ $label }}</label>
                                <input type="text"
                                       name="{{ $name }}"
                                       class="mt-1 block w-full p-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                                       id="{{ $name }}"
                                       @if(in_array($name, ['name', 'contact', 'email', 'address', 'username'])) required @endif>
                            </div>
                        @endforeach

                        <button type="submit" class="mt-4 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition duration-200">Add Coordinator</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
