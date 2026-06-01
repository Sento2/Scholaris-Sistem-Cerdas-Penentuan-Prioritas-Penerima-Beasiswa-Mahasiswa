<aside class="w-64 bg-[#f8fafc] border-r border-gray-100 flex-shrink-0 min-h-screen flex flex-col justify-between hidden md:flex transition-all">
    <div>
        <!-- Logo -->
        <div class="h-20 flex items-center px-8">
            <a href="{{ route('admin.dashboard') }}" class="flex flex-col">
                <span class="text-2xl font-extrabold text-[#0f172a] tracking-tight">Scholaris</span>
                <span class="text-[10px] uppercase tracking-wider font-bold text-gray-500">Sistem Rekomendasi</span>
            </a>
        </div>

        <!-- Menu Links -->
        <nav class="px-4 py-6 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-emerald-50/70 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-500 hover:bg-gray-100/50 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.dashboard') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>

            <a href="{{ route('admin.data') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('admin.data') ? 'bg-emerald-50/70 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-500 hover:bg-gray-100/50 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.data') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                Pendaftar
            </a>

            <a href="{{ route('admin.ranking') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('admin.ranking') ? 'bg-emerald-50/70 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-500 hover:bg-gray-100/50 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.ranking') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                Ranking SAW
            </a>

            <a href="{{ route('admin.bobot') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('admin.bobot') ? 'bg-emerald-50/70 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-500 hover:bg-gray-100/50 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.bobot') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
                Kriteria & Bobot
            </a>

            <a href="{{ route('admin.laporan') }}" class="flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors {{ request()->routeIs('admin.laporan') ? 'bg-emerald-50/70 text-emerald-700 border-l-4 border-emerald-600' : 'text-gray-500 hover:bg-gray-100/50 hover:text-gray-800' }}">
                <svg class="w-5 h-5 mr-3 {{ request()->routeIs('admin.laporan') ? 'text-emerald-600' : 'text-gray-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Laporan
            </a>
        </nav>
    </div>

    <div class="px-4 py-6 border-t border-gray-100">

        <form method="POST" action="{{ route('logout') }}" class="mt-1">
            @csrf
            <button type="submit" class="w-full flex items-center px-4 py-3 rounded-xl font-bold text-sm transition-colors text-gray-500 hover:bg-red-50 hover:text-red-600 group">
                <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                Logout
            </button>
        </form>
    </div>
</aside>
