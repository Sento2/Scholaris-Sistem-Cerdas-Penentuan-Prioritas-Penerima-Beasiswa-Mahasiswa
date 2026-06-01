<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">Dashboard Admin</h2>
    </x-slot>

    <!-- ACTION BUTTONS -->
    <div class="flex flex-wrap gap-3 mb-8">
        <form action="{{ route('admin.ranking.hitung') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-emerald-700 text-white rounded-lg font-bold text-sm shadow-sm hover:bg-emerald-800 transition-colors">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Hitung Ranking SAW
            </button>
        </form>
        
        <a href="{{ route('admin.laporan') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg font-bold text-sm shadow-sm hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
            Ekspor Laporan
        </a>
        
        <a href="{{ route('admin.bobot') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-200 text-gray-700 rounded-lg font-bold text-sm shadow-sm hover:bg-gray-50 transition-colors">
            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path></svg>
            Atur Bobot Kriteria
        </a>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <p class="text-sm font-bold text-gray-500">Total Pendaftar</p>
                <div class="w-10 h-10 bg-[#e0e7ff] text-[#4f46e5] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                </div>
            </div>
            <h3 class="text-4xl font-black text-[#0f172a] mt-4">{{ $stats['total_pendaftar'] ?? 0 }}</h3>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <p class="text-sm font-bold text-gray-500">Kuota Beasiswa</p>
                <div class="w-10 h-10 bg-[#d1fae5] text-[#059669] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path></svg>
                </div>
            </div>
            <h3 class="text-4xl font-black text-[#0f172a] mt-4">8 <span class="text-sm font-bold text-gray-400">slots</span></h3>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <p class="text-sm font-bold text-gray-500">Menunggu Verifikasi</p>
                <div class="w-10 h-10 bg-[#ffedd5] text-[#ea580c] rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                </div>
            </div>
            <h3 class="text-4xl font-black text-[#0f172a] mt-4">{{ $stats['menunggu_verif'] ?? 0 }}</h3>
        </div>

        <!-- Card 4 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-between hover:shadow-md transition-all">
            <div class="flex justify-between items-start">
                <p class="text-sm font-bold text-gray-500">Periode Aktif</p>
                <div class="w-10 h-10 bg-gray-100 text-gray-600 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                </div>
            </div>
            <div class="mt-4">
                <h3 class="text-xl font-black text-[#0f172a]">Semester Ganjil</h3>
                <p class="text-sm font-bold text-gray-400">2024/2025</p>
            </div>
        </div>
    </div>

    <!-- MAIN CONTENT AREA -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- TOP 5 RANKING -->
        <div class="lg:col-span-2 bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="px-8 py-6 border-b border-gray-50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                    Top 5 Pendaftar (Ranking SAW)
                </h3>
                <a href="{{ route('admin.ranking') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 hover:underline">Lihat Semua</a>
            </div>
            <div class="p-4">
                @forelse ($topRanking ?? [] as $index => $pengajuan)
                    <div class="flex items-center justify-between p-4 {{ !$loop->last ? 'border-b border-gray-50' : '' }} hover:bg-gray-50 rounded-xl transition-colors">
                        <div class="flex items-center w-full">
                            <div class="w-8 h-8 rounded-full {{ $index == 0 ? 'bg-yellow-100 text-yellow-600' : ($index == 1 ? 'bg-gray-100 text-gray-500' : ($index == 2 ? 'bg-amber-100 text-amber-600' : 'bg-gray-50 text-gray-400')) }} flex items-center justify-center font-bold text-sm mr-4 flex-shrink-0">
                                {{ $pengajuan->rank }}
                            </div>
                            <div class="flex-1 mr-4">
                                <div class="font-bold text-gray-800">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                                <div class="text-xs font-medium text-gray-500">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                <div class="mt-2 w-full bg-gray-100 rounded-full h-1.5">
                                    <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ ($pengajuan->skor_saw ?? 0) * 100 }}%"></div>
                                </div>
                            </div>
                            <div class="font-black text-emerald-600 w-12 text-right">
                                {{ number_format($pengajuan->skor_saw ?? 0, 3) }}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-8 text-center text-gray-500 font-medium">
                        Belum ada data ranking.
                    </div>
                @endforelse
            </div>
        </div>

        <!-- AKTIVITAS TERBARU -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col">
            <div class="px-6 py-6 border-b border-gray-50 flex items-center">
                <svg class="w-5 h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <h3 class="text-lg font-bold text-gray-800">Aktivitas Terbaru</h3>
            </div>
            <div class="p-0 flex-1">
                <ul class="divide-y divide-gray-50">
                    @forelse ($aktivitasTerbaru ?? [] as $index => $aktif)
                        <li class="p-6 hover:bg-gray-50 transition-colors flex">
                            <div class="w-8 h-8 rounded-full bg-blue-50 text-blue-500 flex items-center justify-center flex-shrink-0 mr-4">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 leading-snug">
                                    <span class="font-bold text-gray-800">{{ $aktif->mahasiswa->user->name ?? 'Mahasiswa' }}</span> 
                                    mengunggah berkas persyaratan administrasi.
                                </p>
                                <p class="text-xs font-bold text-gray-400 mt-1">{{ $aktif->created_at ? $aktif->created_at->diffForHumans() : '-' }}</p>
                            </div>
                        </li>
                    @empty
                        <li class="p-6 text-center text-sm font-medium text-gray-500">Belum ada aktivitas baru.</li>
                    @endforelse
                </ul>
            </div>
            <div class="p-4 border-t border-gray-50 text-center">
                <button class="text-xs font-bold text-gray-500 hover:text-emerald-600 transition-colors">Muat Lebih Banyak</button>
            </div>
        </div>

    </div>
</x-admin-layout>
