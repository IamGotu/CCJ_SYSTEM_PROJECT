<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('images/bacround/LOGO (1).jpg') }}'); background-color: #1a1f2e;">
         <br><br>
        <!-- Main Container with Border and Semi-transparent Background -->
        <div class="w-full sm:max-w-xl bg-[#1a1f2e]/90 backdrop-blur-sm rounded-lg border border-gray-700">
            
            <!-- Form Section -->
            <div class="p-0">
                <!-- Register Heading -->
                <h2 class="text-3xl font-bold text-center text-white mb-6">Student Information</h2>
                
                <form method="POST" action="{{ route('students.store') }}" class="w-full max-w-screen-lg mx-auto px-8">
                    @csrf

                    <!-- Student ID -->
                    <div class="mb-6">
                        <label for="student_id_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Student ID Number</label>
                        <input type="text" name="student_id_number" id="student_id_number" 
                            class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                            required>
                    </div>

                    <!-- Name Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">First Name</label>
                            <input type="text" name="first_name" id="first_name" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>
                        <div>
                            <label for="middle_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Middle Name</label>
                            <input type="text" name="middle_name" id="middle_name" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Last Name</label>
                            <input type="text" name="last_name" id="last_name" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                                required>
                        </div>
                        <div>
                            <label for="suffix" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Suffix</label>
                            <input type="text" name="suffix" id="suffix" placeholder="Optional" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <!-- Birthdate -->
                    <div class="mb-6">
                        <label for="birthdate" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Birthdate</label>
                        <input type="date" name="birthdate" id="birthdate" 
                            class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200"
                            required>
                    </div>

                    <!-- Address Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-6">
                        <div>
                            <label for="purok" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Purok</label>
                            <input type="text" name="purok" id="purok" placeholder="Optional" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="street_num" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street Number</label>
                            <input type="text" name="street_num" id="street_num" placeholder="Optional" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="street_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Street Name</label>
                            <input type="text" name="street_name" id="street_name" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="barangay" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Barangay</label>
                            <input type="text" name="barangay" id="barangay" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
                        <div>
                            <label for="city" class="block text-sm font-medium text-gray-700 dark:text-gray-300">City</label>
                            <input type="text" name="city" id="city" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="state" class="block text-sm font-medium text-gray-700 dark:text-gray-300">State</label>
                            <input type="text" name="state" id="state" 
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="postal_num" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Postal Number</label>
                            <input type="text" name="postal_num" id="postal_num" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <!-- Contact Number -->
                    <div class="mb-6">
                        <label for="contact_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Contact Number</label>
                        <input type="text" name="contact_number" id="contact_number" 
                            class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                    </div>

                    <!-- Guardian/s Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="father_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Father Name</label>
                            <input type="text" name="father_name" id="father_name" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="father_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Father Contact</label>
                            <input type="text" name="father_contact" id="father_contact" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="mother_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mother Name</label>
                            <input type="text" name="mother_name" id="mother_name" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="mother_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mother Contact</label>
                            <input type="text" name="mother_contact" id="mother_contact" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
                        <div>
                            <label for="guardian_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guardian Name</label>
                            <input type="text" name="guardian_name" id="guardian_name" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                        <div>
                            <label for="guardian_contact" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Guardian Contact</label>
                            <input type="text" name="guardian_contact" id="guardian_contact" placeholder="Optional"
                                class="mt-1 block w-full p-3 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm focus:outline-none focus:ring focus:ring-blue-400 dark:bg-gray-700 dark:text-gray-200">
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="mt-8 text-center">
                        <button type="submit" class="bg-blue-500 text-white px-8 py-3 rounded hover:bg-blue-600 transition duration-200">Add Student</button>
                    </div>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <span class="text-gray-400">Not a student?</span>
                        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-400 ml-1">Login Page</a>
                    </div>
                </form>
            </div>   
        </div>
        <br><br>
    </div>
</x-guest-layout>