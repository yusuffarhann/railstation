<!-- Sidebar Kiri -->
<div class="sidebar flex flex-col p-4" id="sidebar-menu">
    <!-- Header Sidebar dengan Tombol Toggle -->
    <div class="flex justify-between items-center py-4 border-b border-white border-opacity-20 mb-6">
        <h1 class="text-2xl font-extrabold sidebar-link-text font-archivoblack italic">RailStatiON</h1>
        <button id="sidebar-toggle-btn"
            class="p-2 text-white hover:bg-white hover:bg-opacity-20 rounded-full transition-colors duration-300">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </div>

    <!-- Dropdown Nama Stasiun -->
    <div class="mb-6">
        <p class="text-xs text-white text-opacity-70 mb-1 px-1 sidebar-link-text">Pilih Nama Stasiun Disini</p>
        <select
            class="w-full p-2 bg-white text-blue-900 rounded-lg font-medium border border-gray-300 focus:outline-none focus:ring-2 focus:ring-blue-500"
            id="station-dropdown">
            @foreach ($stationData as $name)
            <option value="{{ $name }}" {{ $station->name == $name ? 'selected' : '' }}>{{ $name }}</option>
            @endforeach
        </select>
    </div>

    <!-- Menu Navigasi -->
    <nav class="flex-grow">
        <ul>
            <x-nav-li :href="route('dashboard')" id="menu-dashboard" icon="fas fa-chart-line" :active="request()->routeIs('dashboard')">Dashboard</x-nav-li>
            <x-nav-li :href="route('profile')" id="menu-profil" icon="fas fa-file-alt" :active="request()->routeIs('profile')">Profil Stasiun</x-nav-li>
            <x-nav-li :href="route('employee')" id="menu-pegawai" icon="fas fa-users" :active="request()->is('employee*')">Data Pegawai</x-nav-li>
            <x-nav-li :href="route('train')" id="menu-perjalanan" icon="fas fa-train" :active="request()->routeIs('train')">Data Perka</x-nav-li>

            <li class="mb-4">
                <div id="menu-administrasi-toggle"
                    class="flex items-center p-3 rounded-lg hover:bg-blue-400 transition-colors duration-200 cursor-pointer {{ request()->routeIs('guard-form', 'operational-disruption', 'ibpr') ? 'bg-blue-500' : '' }}">
                    <span class="sidebar-link-icon-container">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </span>
                    <span class="sidebar-link-text flex-grow">Data Administrasi</span>
                    <i class="fas fa-chevron-down text-white text-sm transition-transform duration-200 {{ request()->routeIs('guard-form', 'operational-disruption', 'ibpr') ? 'rotate-180' : '' }}"></i>
                </div>
                <ul id="administrasi-submenu" class="mt-2 space-y-2 submenu-transition {{ request()->routeIs('guard-form', 'operational-disruption', 'ibpr') ? 'submenu-open' : '' }}">
                    <li>
                        <a href="{{ route('ibpr') }}" id="submenu-ibpr"
                            class="flex items-center p-3 rounded-lg text-white {{ request()->routeIs('ibpr') ? 'bg-blue-500' : 'hover:bg-blue-400' }}">
                            <i class="fas fa-file-invoice mr-3 w-8 text-center"></i>
                            <span class="sidebar-link-text">IBPR</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('guard-form') }}" id="submenu-penjagaan-bentuk"
                            class="flex items-center p-3 rounded-lg text-white {{ request()->routeIs('guard-form') ? 'bg-blue-500' : 'hover:bg-blue-400' }}">
                            <i class="fas fa-list-alt mr-3 w-8 text-center"></i>
                            <span class="sidebar-link-text">Penjagaan Bentuk - Bentuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('krsm') }}" id="submenu-penggunaan"
                            class="flex items-center p-3 rounded-lg text-white {{ request()->routeIs('krsm') ? 'bg-blue-500' : 'hover:bg-blue-400' }}">
                            <i class="fas fa-id-card mr-3 w-8 text-center"></i>
                            <span class="sidebar-link-text">Penggunaan KR dan SM</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('operational-disruption') }}" id="submenu-gangguan"
                            class="flex items-center p-3 rounded-lg text-white {{ request()->routeIs('operational-disruption') ? 'bg-blue-500' : 'hover:bg-blue-400' }}">
                            <i class="fas fa-exclamation-triangle mr-3 w-8 text-center"></i>
                            <span class="sidebar-link-text">Gangguan Operasional</span>
                        </a>
                    </li>
                </ul>
            </li>
            <x-nav-li :href="route('railibrary')" id="menu-railibrary" icon="fas fa-book" :active="request()->routeIs('railibrary')">RaiLibrary</x-nav-li>
        </ul>
    </nav>

    <!-- Footer Copyright -->
    <div class="mt-auto pt-6 text-center text-xs text-white text-opacity-50 sidebar-link-text">
        <p>© 2025 All Rights Reserved</p>
        <p>Last Update : (10 September 2025)</p>
        <p>Built By : 69451</p>
    </div>
</div>
