<nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
    <div class="flex items-center justify-between px-4 py-3">

        <!-- SIDEBAR TOGGLE BUTTON -->
        <button onclick="toggleSidebar()"
            class="text-gray-700 text-2xl focus:outline-none">
            <i class="fas fa-bars"></i>
        </button>

        <!-- LOGO / TITLE -->
        <h1 class="text-xl font-bold text-blue-600">
            Sistem Penyewaan Kost
        </h1>

        <!-- USER + LOGOUT DROPDOWN -->
        <div class="relative" x-data="{ open:false }">

            <!-- USER BUTTON -->
            <button @click="open = !open"
                    class="flex items-center space-x-2 bg-gray-100 px-3 py-2 rounded-lg hover:bg-gray-200 transition">

                <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'User' }}"
                     class="w-8 h-8 rounded-full">

                <span class="font-medium">
                    {{ Auth::user()->name ?? 'User' }}
                </span>

                <i class="fas fa-chevron-down text-sm"></i>
            </button>

            <!-- DROPDOWN -->
            <div x-show="open"
                 @click.away="open = false"
                 x-transition
                 class="absolute right-0 mt-2 w-40 bg-white shadow-lg rounded-lg overflow-hidden">

                <!-- Profile (optional) -->
                <a href="{{ route('profile') }}"
                   class="block px-4 py-2 hover:bg-gray-100">
                    <i class="fas fa-user mr-2"></i> Profil
                </a>

                <!-- Logout -->
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                            class="w-full text-left px-4 py-2 hover:bg-red-100 text-red-600">
                        <i class="fas fa-sign-out-alt mr-2"></i> Logout
                    </button>
                </form>

            </div>
        </div>
    </div>
</nav>
