<!-- BACKDROP -->
<div id="sidebarBackdrop"
     class="fixed inset-0 bg-black bg-opacity-40 hidden z-40"
     onclick="toggleSidebar()">
</div>

<!-- SIDEBAR -->
<aside id="sidebar"
       class="fixed top-0 left-0 w-64 h-full bg-gray-900 text-white transform -translate-x-full transition-transform duration-300 z-50">

    <div class="p-6 border-b border-gray-700">
        <h2 class="text-xl font-bold">Menu</h2>
    </div>

    <ul class="p-4 space-y-2">

        <li>
            <a href="{{ route('admin.dashboard') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                <i class="fas fa-home mr-2"></i> Dashboard
            </a>
        </li>

        <li>
            <a href="{{ route('admin.booking.index') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                <i class="fas fa-list mr-2"></i> Booking
            </a>
        </li>

<li>
    <a href="{{ url('/penyewa/kost/1') }}"
       class="block px-4 py-2 rounded hover:bg-gray-700 transition">
        <i class="fas fa-bed mr-2"></i> Data Kamar
    </a>
</li>



        <li>
            <a href="{{ route('admin.settings') }}"
               class="block px-4 py-2 rounded hover:bg-gray-700 transition">
                <i class="fas fa-cog mr-2"></i> Pengaturan
            </a>
        </li>

    </ul>
</aside>

<!-- SCRIPT -->
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('sidebar');
        const backdrop = document.getElementById('sidebarBackdrop');

        sidebar.classList.toggle('-translate-x-full');
        backdrop.classList.toggle('hidden');
    }
</script>
