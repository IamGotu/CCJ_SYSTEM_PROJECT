<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('images/bacround/LOGO (1).jpg') }}'); background-color: #1a1f2e;">
        <!-- Main Container with Border and Semi-transparent Background -->
        <div class="w-full sm:max-w-xl bg-[#1a1f2e]/90 backdrop-blur-sm rounded-lg border border-gray-700">
            <!-- Form Section -->
            <div class="p-8">
                <!-- Register Heading -->
                <h2 class="text-3xl font-bold text-center text-white mb-6">Register</h2>
                
                <form method="POST" action="{{ route('register') }}" class="space-y-6">
                    @csrf

                    <!-- Name -->
                    <div>
                        <label for="name" class="block text-gray-300 text-sm mb-2">Name</label>
                        <input type="text" 
                               name="name" 
                               id="name" 
                               class="w-full px-4 py-2 bg-[#0f1218] border border-blue-500 rounded-md text-gray-200 focus:border-blue-600 focus:ring-0"
                               required 
                               autofocus>
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-300 text-sm mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="w-full px-4 py-2 bg-[#0f1218] border border-blue-500 rounded-md text-gray-200 focus:border-blue-600 focus:ring-0"
                               required>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-300 text-sm mb-2">Password</label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="w-full px-4 py-2 bg-[#0f1218] border border-blue-500 rounded-md text-gray-200 focus:border-blue-600 focus:ring-0"
                               required>
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label for="password_confirmation" class="block text-gray-300 text-sm mb-2">Confirm Password</label>
                        <input type="password" 
                               name="password_confirmation" 
                               id="password_confirmation" 
                               class="w-full px-4 py-2 bg-[#0f1218] border border-blue-500 rounded-md text-gray-200 focus:border-blue-600 focus:ring-0"
                               required>
                    </div>

                    <!-- Register Button -->
                    <button type="submit" class="w-full py-3 bg-blue-500 hover:bg-blue-600 text-white rounded-lg mt-6">
                        REGISTER
                    </button>

                    <!-- Login Link -->
                    <div class="text-center mt-4">
                        <span class="text-gray-400">Already have an account?</span>
                        <a href="{{ route('login') }}" class="text-blue-500 hover:text-blue-400 ml-1">Sign In</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
