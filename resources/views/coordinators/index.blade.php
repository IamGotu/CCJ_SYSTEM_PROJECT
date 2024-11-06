<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight"">
            {{ __('Coordinators') }}
        </h2>
    </x-slot>

    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">

            <!-- Secondary Navigation -->
            <nav class="flex space-x-4 mb-4">
                <a href="{{ route('ojt_records.index') }}" class="text-gray-700 hover:text-blue-600">OJT Records</a>
                <a href="{{ route('coordinators.index') }}" class="text-gray-700 hover:text-blue-600">Coordinators</a>
            </nav>

                    <a href="{{ route('coordinators.create') }}" class="bg-blue-600 text-white py-2 px-4 rounded hover:bg-blue-700">
                        Add Coordinator
                    </a>

                     <!-- Search Form -->
                        <div class="flex flex-col sm:flex-row sm:items-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
                            <form method="GET" action="{{ route('coordinators.index') }}" class="flex flex-col sm:flex-row sm:space-x-2 w-full sm:w-auto">
                                <!-- Search Input -->
                                <input type="text" name="search" placeholder="Search by Coordinators name"
                                    class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-60"
                                    value="{{ request('search') }}">
                                <!-- Search Button -->
                                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                                    Search
                                </button>
                            </form>
                            <!-- Refresh Button -->
                            <a href="{{ route('coordinators.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 sm:ml-2">
                                Refresh
                            </a>
                        </div>

                    <div class="overflow-x-auto mt-4">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-200">
                                <tr>
                                    <th class="py-2 px-4 text-center">Name</th>
                                    <th class="py-2 px-4 text-center">Contact</th>
                                    <th class="py-2 px-4 text-center">Email</th>
                                    <th class="py-2 px-4 text-center">Address</th>
                                    <th class="py-2 px-4 text-center">Username</th>
                                    <th class="py-2 px-4 text-center">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($coordinators as $coordinator)
                                    <tr>
                                        <td class="py-2 px-4 text-center">{{ $coordinator->name }}</td>
                                        <td class="py-2 px-4 text-center">{{ $coordinator->contact }}</td>
                                        <td class="py-2 px-4 text-center">{{ $coordinator->email }}</td>
                                        <td class="py-2 px-4 text-center">{{ $coordinator->address }}</td>
                                        <td class="py-2 px-4 text-center">{{ $coordinator->username }}</td>
                                        <td class="py-2 px-4 text-center">
                                            <a href="{{ route('coordinators.edit', $coordinator) }}" class="text-blue-500">Edit</a>
                                            <form action="{{ route('coordinators.destroy', $coordinator) }}" method="POST" style="display: inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-500">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
