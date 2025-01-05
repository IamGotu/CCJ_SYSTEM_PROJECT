<x-guest-layout>
    <div class="min-h-screen flex flex-col items-center justify-center bg-cover bg-center bg-no-repeat" 
         style="background-image: url('{{ asset('images/bacround/LOGO (1).jpg') }}'); background-color: #1a1f2e;">
        <!-- Main Container with Border and Semi-transparent Background -->
        <div class="w-full sm:max-w-xl bg-[#1a1f2e]/90 backdrop-blur-sm rounded-lg border border-gray-700">
            <!-- Form Section -->
            <div class="p-8">
                <!-- Sign In Heading -->
                <h2 class="text-3xl font-bold text-center text-white mb-6"></h2>
                
                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-gray-300 text-sm mb-2">Email</label>
                        <input type="email" 
                               name="email" 
                               id="email" 
                               class="w-full px-4 py-2 bg-[#0f1218] border border-blue-500 rounded-md text-gray-200 focus:border-blue-600 focus:ring-0"
                               required 
                               autofocus>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-gray-300 text-sm mb-2">Password</label>
                        <input type="password" 
                               name="password" 
                               id="password" 
                               class="w-full px-4 py-2 bg-[#0f1218] border border-gray-700 rounded-md text-gray-200 focus:border-blue-500 focus:ring-0"
                               required>
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input type="checkbox" 
                               name="remember" 
                               id="remember" 
                               class="w-4 h-4 bg-[#0f1218] border-gray-700 rounded">
                        <label for="remember" class="ml-2 text-sm text-gray-400">Remember me</label>
                    </div>
    
                    <!-- Login Button -->
                    <button type="submit" 
                            class="w-full py-2.5 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-semibold rounded-md transition duration-200 hover:opacity-90">
                        LOG IN
                    </button>

                    <!-- Add Register Link -->
                    <div class="text-center mt-4">
                        <span class="text-gray-400">Are you a student?</span>
                        <a href="{{ route('register') }}" class="text-blue-500 hover:text-blue-400 ml-1">Register here</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>
