<x-app-layout>
    <div class="py-6 px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Students Profile Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:bg-gray-100 transition-all">
                <a href="{{ route('students.index') }}" class="block text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Students Profile</h2>
                    <p class="text-gray-600">Manage student profiles and view details.</p>
                </a>
            </div>

            <!-- Derogatory Records Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:bg-gray-100 transition-all">
                <a href="{{ route('derogatory_records.index') }}" class="block text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Derogatory Records</h2>
                    <p class="text-gray-600">Manage and view derogatory records.</p>
                </a>
            </div>

            <!-- Interns Profile Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:bg-gray-100 transition-all">
                <a href="{{ route('intern.profile') }}" class="block text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Interns Profile</h2>
                    <p class="text-gray-600">Track intern profiles and status.</p>
                </a>
            </div>

            <!-- OJT Records Card -->
            <div class="bg-white p-6 rounded-lg shadow-lg hover:bg-gray-100 transition-all">
                <a href="{{ route('ojt.records') }}" class="block text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">OJT Records</h2>
                    <p class="text-gray-600">View and manage OJT records.</p>
                </a>
            </div>
        </div>
    </div>
</x-app-layout>