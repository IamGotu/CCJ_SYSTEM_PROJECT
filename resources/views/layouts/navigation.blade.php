<nav x-data="{ open: false }" class="bg-gradient-to-r from-gray-900 to-gray-800 border-b border-gray-700 shadow-lg">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center space-x-8">
                <!-- Logo and System Name -->
                <div class="flex items-center space-x-3">
                    <a href="{{ route('dashboard') }}" class="group">
                        <x-application-logo class="block h-12 w-auto transition-transform duration-300 group-hover:scale-105" />
                    </a>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-blue-600 text-transparent bg-clip-text">
                        CCJ System
                    </span>
                </div>

                <!-- Main Navigation Links -->
                <div class="hidden sm:flex sm:items-center space-x-6">
                    <a href="{{ route('students.index') }}" class="text-gray-300 hover:text-blue-400 px-3 py-2 text-sm font-medium">
                        Students Profile
                    </a>
                    <a href="{{ route('derogatory_records.index') }}" class="text-gray-300 hover:text-blue-400 px-3 py-2 text-sm font-medium">
                        Derogatory Records
                    </a>
                    <a href="{{ route('intern.index') }}" class="text-gray-300 hover:text-blue-400 px-3 py-2 text-sm font-medium">
                        Interns Profile
                    </a>
                    <a href="{{ route('ojt_records.index') }}" class="text-gray-300 hover:text-blue-400 px-3 py-2 text-sm font-medium">
                        OJT Records
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="flex items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-2 px-4 py-2 bg-gray-800 border border-gray-600 rounded-lg hover:bg-gray-700 transition duration-150 ease-in-out group">
                            @if (!Auth::check())
                                <script>window.location = "{{ route('login') }}";</script>
                            @else
                                <div class="text-gray-300 group-hover:text-white">
                                    {{ Auth::user()->name }}
                                </div>
                            @endif
                            <svg class="w-5 h-5 text-gray-400 group-hover:text-white transition-transform duration-200 group-hover:-rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-gray-800 border border-gray-700 rounded-lg shadow-xl">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-t-lg">
                                <div class="flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                                    {{ __('Profile') }}
                                </div>
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault(); this.closest('form').submit();"
                                    class="text-gray-300 hover:bg-gray-700 hover:text-white px-4 py-2 rounded-b-lg">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                        </svg>
                                        {{ __('Log Out') }}
                                    </div>
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
