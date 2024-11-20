<x-app-layout>
    <!-- Main Content -->
    <div class="bg-[#0f1218] min-h-screen">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
                <!-- Total Students Card -->
                <div class="bg-gradient-to-br from-blue-500 to-blue-700 rounded-lg p-6 shadow-xl transform transition duration-300 hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white">Total Students</h3>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalStudents ?? 0 }}</p>
                        </div>
                        <div class="text-white text-3xl opacity-80">
                            <i class="fas fa-users"></i>
                        </div>
                    </div>
                    <a href="{{ route('students.index') }}" class="text-white text-sm mt-4 block hover:underline">
                        View Student Profiles →
                    </a>
                </div>

                <!-- Derogatory Records Card -->
                <div class="bg-gradient-to-br from-red-500 to-red-700 rounded-lg p-6 shadow-xl transform transition duration-300 hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white">Derogatory Records</h3>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalDerogatory ?? 0 }}</p>
                        </div>
                        <div class="text-white text-3xl opacity-80">
                            <i class="fas fa-exclamation-triangle"></i>
                        </div>
                    </div>
                    <a href="{{ route('derogatory_records.index') }}" class="text-white text-sm mt-4 block hover:underline">
                        View Derogatory Records →
                    </a>
                </div>

                <!-- Active Interns Card -->
                <div class="bg-gradient-to-br from-green-500 to-green-700 rounded-lg p-6 shadow-xl transform transition duration-300 hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white">Active Interns</h3>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalInterns ?? 0 }}</p>
                        </div>
                        <div class="text-white text-3xl opacity-80">
                            <i class="fas fa-user-graduate"></i>
                        </div>
                    </div>
                    <a href="{{ route('intern.index') }}" class="text-white text-sm mt-4 block hover:underline">
                        View Intern Profiles →
                    </a>
                </div>

                <!-- OJT Records Card -->
                <div class="bg-gradient-to-br from-purple-500 to-purple-700 rounded-lg p-6 shadow-xl transform transition duration-300 hover:scale-105">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-semibold text-white">OJT Records</h3>
                            <p class="text-3xl font-bold text-white mt-2">{{ $totalOJT ?? 0 }}</p>
                        </div>
                        <div class="text-white text-3xl opacity-80">
                            <i class="fas fa-file-alt"></i>
                        </div>
                    </div>
                    <a href="{{ route('ojt_records.index') }}" class="text-white text-sm mt-4 block hover:underline">
                        View OJT Records →
                    </a>
                </div>
            </div>

            <!-- Recent Activities Section -->
            <div class="mt-8">
                <h2 class="text-xl font-semibold text-white mb-4">Recent Activities</h2>
                <div class="bg-[#1a1f2e] rounded-lg shadow-xl p-6">
                    <div class="space-y-4">
                        <!-- Add your recent activities here -->
                        <div class="flex items-center text-gray-300">
                            <div class="w-2 h-2 bg-blue-500 rounded-full mr-3"></div>
                            <span>New student profile added</span>
                            <span class="ml-auto text-sm text-gray-500">2 hours ago</span>
                        </div>
                        <!-- Add more activity items as needed -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout> 