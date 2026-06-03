<nav class="max-w-7xl mx-auto flex items-center justify-between px-6 md:px-10 py-4" x-data="{ mobileMenuOpen: false }">
    <!-- Logo -->
    <div class="flex items-center">
        @php
            $dashboardRoute = 'dashboard';
            if (Auth::user()->isMahasiswa()) $dashboardRoute = 'mahasiswa.dashboard';
            elseif (Auth::user()->isDosen()) $dashboardRoute = 'dosen.bimbingan'; // Dosen doesn't have a specific dashboard route, uses bimbingan
            elseif (Auth::user()->isAdmin()) $dashboardRoute = 'admin.dashboard';
        @endphp
        <a href="{{ route($dashboardRoute) }}" class="text-xl font-extrabold text-emerald-700 tracking-tight cursor-pointer transform hover:scale-105 transition-transform">
            Scholaris
        </a>
    </div>

    <!-- Links -->
    <div class="hidden md:flex items-center space-x-8">
        @if(Auth::user()->isMahasiswa())
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('mahasiswa.dashboard') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Beranda</a>
            <a href="{{ route('mahasiswa.beasiswa') }}" class="text-sm font-semibold {{ request()->routeIs('mahasiswa.beasiswa') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Info Beasiswa</a>
            <a href="{{ route('mahasiswa.daftar') }}" class="text-sm font-semibold {{ request()->routeIs('mahasiswa.daftar') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Daftar Beasiswa</a>
            <a href="{{ route('mahasiswa.status') }}" class="text-sm font-semibold {{ request()->routeIs('mahasiswa.status') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Status</a>
            <a href="{{ route('mahasiswa.skor') }}" class="text-sm font-semibold {{ request()->routeIs('mahasiswa.skor') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Skor SAW</a>
        
        @elseif(Auth::user()->isDosen())
            <a href="{{ route('dosen.bimbingan') }}" class="text-sm font-semibold {{ request()->routeIs('dosen.bimbingan') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Mahasiswa Bimbingan</a>
            <a href="{{ route('dosen.laporan') }}" class="text-sm font-semibold {{ request()->routeIs('dosen.laporan') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Laporan</a>
        
        @elseif(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold {{ request()->routeIs('admin.dashboard') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Dashboard</a>
            <a href="{{ route('admin.data') }}" class="text-sm font-semibold {{ request()->routeIs('admin.data') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Kelola Pengajuan</a>
            <a href="{{ route('admin.bobot') }}" class="text-sm font-semibold {{ request()->routeIs('admin.bobot') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Bobot SAW</a>
            <a href="{{ route('admin.ranking') }}" class="text-sm font-semibold {{ request()->routeIs('admin.ranking') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Ranking</a>
            <a href="{{ route('admin.laporan') }}" class="text-sm font-semibold {{ request()->routeIs('admin.laporan') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Laporan</a>
        @endif
        
        @if(Auth::user()->isMahasiswa())
            <a href="{{ route('mahasiswa.profil.edit') }}" class="text-sm font-semibold {{ request()->routeIs('mahasiswa.profil.*') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Profil</a>
        @else
            <a href="{{ route('profile.edit') }}" class="text-sm font-semibold {{ request()->routeIs('profile.edit') ? 'text-emerald-700 border-b-2 border-emerald-600 pb-1.5 px-1' : 'text-gray-500 hover:text-gray-800 hover:border-gray-300 border-b-2 border-transparent pb-1.5 px-1 transition-all' }}">Profil</a>
        @endif
    </div>

    <!-- Profile & Actions -->
    <div class="flex items-center space-x-5 relative">
        <!-- Notification Bell -->
        <div x-data="{ notifOpen: false }" class="relative hidden md:block">
            <button @click="notifOpen = !notifOpen" class="text-gray-400 hover:text-emerald-600 transition-colors transform hover:rotate-12 relative pt-2">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                @if(Auth::user()->unreadNotifications->count() > 0)
                    <span class="absolute top-0 right-0 inline-flex items-center justify-center w-4 h-4 text-[10px] font-bold leading-none text-white bg-red-500 rounded-full border-2 border-white">{{ Auth::user()->unreadNotifications->count() }}</span>
                @endif
            </button>
            
            <!-- Dropdown Content -->
            <div x-show="notifOpen" @click.away="notifOpen = false" x-cloak
                 class="absolute right-0 top-10 mt-2 w-80 bg-white rounded-xl shadow-lg border border-gray-100 z-50 overflow-hidden"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100">
                <div class="px-4 py-3 bg-gray-50 border-b border-gray-100 flex justify-between items-center">
                    <span class="text-sm font-bold text-gray-700">Notifikasi</span>
                    @if(Auth::user()->unreadNotifications->count() > 0)
                        <a href="{{ route('notifications.readAll') }}" class="text-[11px] font-medium text-emerald-600 hover:text-emerald-800">Tandai dibaca</a>
                    @endif
                </div>
                <div class="max-h-72 overflow-y-auto">
                    @forelse(Auth::user()->unreadNotifications as $notification)
                        <a href="{{ route('notifications.read', $notification->id) }}" class="block px-4 py-3 border-b border-gray-50 hover:bg-gray-50 transition-colors">
                            <div class="flex items-start">
                                <div class="flex-1">
                                    <p class="text-xs text-gray-800 font-medium">{{ $notification->data['pesan'] ?? 'Notifikasi baru' }}</p>
                                    <p class="text-[10px] text-gray-400 mt-1">{{ $notification->created_at->diffForHumans() }}</p>
                                </div>
                            </div>
                        </a>
                    @empty
                        <div class="px-4 py-8 text-center text-gray-400 text-sm">Belum ada notifikasi.</div>
                    @endforelse
                </div>
            </div>
        </div>
        
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&color=059669&background=ecfdf5" alt="Avatar" class="w-9 h-9 rounded-full border border-gray-200 shadow-sm transform hover:scale-110 transition-transform">
            </button>

            <!-- Dropdown -->
            <div x-show="open" @click.away="open = false" x-cloak
                 class="absolute right-0 top-12 mt-2 w-48 bg-white rounded-md shadow-lg py-1 border border-gray-100 z-50"
                 x-transition:enter="transition ease-out duration-100"
                 x-transition:enter-start="transform opacity-0 scale-95"
                 x-transition:enter-end="transform opacity-100 scale-100"
                 x-transition:leave="transition ease-in duration-75"
                 x-transition:leave-start="transform opacity-100 scale-100"
                 x-transition:leave-end="transform opacity-0 scale-95">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50 hover:text-emerald-700">Log Out</button>
                </form>
            </div>
        </div>

        <!-- Mobile Menu Toggle -->
        <button @click="mobileMenuOpen = !mobileMenuOpen" class="md:hidden text-gray-400 hover:text-emerald-600 transition-colors focus:outline-none">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="!mobileMenuOpen"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-show="mobileMenuOpen" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>
    </div>

    <!-- Mobile Navigation (Absolute Dropdown) -->
    <div x-show="mobileMenuOpen" x-cloak
         class="absolute top-[72px] left-0 right-0 bg-white shadow-md border-b border-gray-100 py-2 px-4 z-40 md:hidden flex flex-col space-y-1">
         
        @if(Auth::user()->isMahasiswa())
            <a href="{{ route('mahasiswa.dashboard') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('mahasiswa.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Beranda</a>
            <a href="{{ route('mahasiswa.beasiswa') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('mahasiswa.beasiswa') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Beasiswa</a>
            <a href="{{ route('mahasiswa.daftar') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('mahasiswa.daftar') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Daftar Beasiswa</a>
            <a href="{{ route('mahasiswa.status') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('mahasiswa.status') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Status</a>
            <a href="{{ route('mahasiswa.skor') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('mahasiswa.skor') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Skor SAW</a>
        @elseif(Auth::user()->isDosen())
            <a href="{{ route('dosen.bimbingan') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('dosen.bimbingan') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Mahasiswa Bimbingan</a>
            <a href="{{ route('dosen.laporan') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('dosen.laporan') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Laporan</a>
        @elseif(Auth::user()->isAdmin())
            <a href="{{ route('admin.dashboard') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Dashboard</a>
            <a href="{{ route('admin.data') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('admin.data') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Kelola Pengajuan</a>
            <a href="{{ route('admin.bobot') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('admin.bobot') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Bobot SAW</a>
            <a href="{{ route('admin.ranking') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('admin.ranking') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Ranking</a>
            <a href="{{ route('admin.laporan') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('admin.laporan') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Laporan</a>
        @endif
        @if(Auth::user()->isMahasiswa())
            <a href="{{ route('mahasiswa.profil.edit') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('mahasiswa.profil.*') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Profil</a>
        @else
            <a href="{{ route('profile.edit') }}" class="text-sm font-semibold px-2 py-3 rounded-md {{ request()->routeIs('profile.edit') ? 'bg-emerald-50 text-emerald-700' : 'text-gray-700 hover:bg-gray-50' }}">Profil</a>
        @endif
    </div>
</nav>
