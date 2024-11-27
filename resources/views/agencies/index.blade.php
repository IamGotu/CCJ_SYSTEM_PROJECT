<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Agency') }}
        </h2>
    </x-slot>

            <!-- Display Success Message -->
            @if(session('success'))
                <div id="success-message" class="bg-green-500 text-white p-4 rounded-md mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Display Error Message -->
            @if(session('error'))
                <div id="error-message" class="bg-red-500 text-white p-4 rounded-md mb-4">
                    {{ session('error') }}
                </div>
            @endif


    <div class="py-1">
        <div class="max-w mx-auto sm:px-6 lg:px-5">

            <!-- Secondary Navigation -->
            <nav class="flex space-x-4 mb-4">
                <a href="{{ route('ojt_records.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('ojt_records.index') ? 'text-blue-600' : '' }}">OJT Records</a>
                <a href="{{ route('coordinators.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('coordinators.index') ? 'text-blue-600' : '' }}">Coordinators</a>
                <a href="{{ route('agencies.index') }}" class="text-gray-700 hover:text-blue-600 {{ request()->routeIs('agencies.index') ? 'text-blue-600' : '' }}">Agency</a>
            </nav>

            <!-- Import Form -->
            <div class="flex flex-col sm:flex-row sm:items-center mt-4 space-y-2 sm:space-y-0 sm:space-x-2">
            <form method="POST" action="{{ route('agencies.import') }}" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file" class="p-1 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200">
                <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200 ml-2">Import Agencies</button>
            </form>


                <form method="GET" action="{{ route('agencies.index') }}" class="flex flex-col sm:flex-row sm:space-x-2 w-full sm:w-auto">
                    <!-- Search Input -->
                    <input type="text" name="search" placeholder="Search by Agency name"
                        class="p-2 border border-gray-300 rounded-md dark:bg-gray-700 dark:text-gray-200 w-full sm:w-60"
                        value="{{ request('search') }}">
                    <!-- Search Button -->
                    <button type="submit" class="bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600 transition duration-200">
                        Search
                    </button>
                </form>
                <!-- Refresh Button -->
                <a href="{{ route('agencies.index') }}" class="bg-gray-500 text-white py-2 px-4 rounded hover:bg-gray-600 transition duration-200 sm:ml-2">
                    Refresh
                </a>
            </div>
        </div>

        <div class="overflow-x-auto mt-6 px-4 sm:px-6 lg:px-5">
            <table class="min-w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600">
                <thead class="bg-gray-100 dark:bg-gray-800 text-gray-500 dark:text-gray-300 text-xs font-medium uppercase tracking-wider">
                    <tr>
                        <th class="py-6 px-4 text-center">Agency Name</th>
                        <th class="py-6 px-4 text-center">Contact Person</th>
                        <th class="py-6 px-4 text-center">Contact Number</th>
                        <th class="py-6 px-4 text-center">Address</th>
                        <th class="py-6 px-4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($agencies as $agency)
                        <tr>
                            <td class="py-6 px-4 text-center">{{ $agency->name }}</td>
                            <td class="py-6 px-4 text-center">{{ $agency->contact_person }}</td>
                            <td class="py-6 px-4 text-center">{{ $agency->contact_number }}</td>
                            <td class="py-6 px-4 text-center">{{ $agency->address }}</td>
                            <td class="py-6 px-4 text-center">
                                <a href="{{ route('agencies.edit', $agency) }}" class="text-blue-500">Edit</a>
                                <form action="{{ route('agencies.destroy', $agency) }}" method="POST" style="display: inline;" onsubmit="return confirmDelete()">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-6 px-4 text-center text-gray-500">No records found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function confirmDelete() {
            return confirm('Are you sure you want to delete this agency? This action cannot be undone.');
        }

            setTimeout(function() {
            const successMessage = document.getElementById('success-message');
            const errorMessage = document.getElementById('error-message');

            if (successMessage) {
                successMessage.style.display = 'none';
            }

            if (errorMessage) {
                errorMessage.style.display = 'none';
            }
        }, 3000); // 3000 milliseconds = 3 seconds
    </script>

</x-app-layout>
