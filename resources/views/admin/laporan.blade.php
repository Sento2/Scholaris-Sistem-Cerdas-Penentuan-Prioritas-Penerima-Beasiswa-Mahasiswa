<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">Laporan & Statistik</h2>
    </x-slot>

    <!-- Print Header (hanya muncul saat cetak) -->
    <div class="print-header">
        <h1>LAPORAN PENERIMAAN BEASISWA</h1>
        <p>Sistem Rekomendasi Beasiswa &mdash; Dicetak pada {{ \Carbon\Carbon::now()->translatedFormat('d F Y, H:i') }} WIB</p>
    </div>

    <!-- Header Actions -->
    <div id="laporan-header-actions" class="mb-8 flex flex-col md:flex-row justify-between items-center animate-fade-in">
        <div class="text-center md:text-left mb-4 md:mb-0">
            <h2 class="text-2xl font-bold text-gray-800">Laporan Penerimaan Beasiswa</h2>
            <p class="text-gray-500 mt-1 text-sm font-medium">Ringkasan statistik dan rekapitulasi data pendaftar.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.laporan.excel') }}" class="inline-flex justify-center items-center px-5 py-2.5 bg-white border border-emerald-200 text-emerald-700 rounded-xl font-bold text-sm shadow-sm hover:bg-emerald-50 hover:shadow transition-all group">
                <svg class="w-5 h-5 mr-2 text-emerald-500 group-hover:text-emerald-600 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Unduh Excel
            </a>
            <a href="{{ route('admin.laporan.pdf') }}" class="inline-flex justify-center items-center px-5 py-2.5 bg-red-600 border border-transparent text-white rounded-xl font-bold text-sm shadow-sm hover:bg-red-700 hover:shadow transition-all group">
                <svg class="w-5 h-5 mr-2 text-red-200 group-hover:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Unduh PDF
            </a>
        </div>
    </div>

    <!-- STATS CARDS -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
        <!-- Card 1 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center animate-slide-up delay-100 hover:shadow-md hover:-translate-y-1 transition-all">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Total Pendaftar</p>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ $totalStats['total_pendaftar'] ?? 0 }}</h3>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center animate-slide-up delay-200 hover:shadow-md hover:-translate-y-1 transition-all">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Diterima</p>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-bold text-emerald-600">{{ $totalStats['total_diterima'] ?? 0 }}</h3>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center animate-slide-up delay-300 hover:shadow-md hover:-translate-y-1 transition-all">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Ditolak</p>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-red-50 text-red-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                </div>
                <h3 class="text-4xl font-bold text-red-600">{{ $totalStats['total_ditolak'] ?? 0 }}</h3>
            </div>
        </div>
        
        <!-- Card 4 -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 flex flex-col justify-center animate-slide-up delay-400 hover:shadow-md hover:-translate-y-1 transition-all">
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-2">Rata-rata Skor</p>
            <div class="flex items-center space-x-3">
                <div class="w-12 h-12 bg-purple-50 text-purple-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                </div>
                <h3 class="text-4xl font-bold text-gray-800">{{ number_format($totalStats['rata_skor'] ?? 0, 3) }}</h3>
            </div>
        </div>
    </div>

    <!-- DISTRIBUSI GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
        <!-- Prodi -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-500">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">Penerima Berdasarkan Prodi</h3>
            </div>
            <div class="p-2">
                <table class="w-full text-left">
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse ($perProdi ?? [] as $prodi => $stats)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-700">{{ $prodi ?: 'Tidak Diketahui' }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-emerald-600 font-black text-lg">{{ $stats['diterima'] ?? 0 }}</span>
                                    <span class="text-gray-300 mx-1">/</span>
                                    <span class="text-gray-500 font-medium">{{ $stats['total'] ?? 0 }} Pendaftar</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-gray-500 font-medium">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Angkatan -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-500">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                <h3 class="text-lg font-bold text-gray-800">Pendaftar Berdasarkan Angkatan</h3>
            </div>
            <div class="p-2">
                <table class="w-full text-left">
                    <tbody class="divide-y divide-gray-50 text-sm">
                        @forelse ($perAngkatan ?? [] as $angkatan => $stats)
                            <tr class="hover:bg-gray-50 transition-colors">
                                <td class="px-6 py-4 font-bold text-gray-700">Angkatan {{ $angkatan ?: 'Tidak Diketahui' }}</td>
                                <td class="px-6 py-4 text-right">
                                    <span class="text-gray-800 font-black text-lg">{{ $stats['total'] ?? 0 }}</span>
                                    <span class="text-gray-500 font-medium ml-1">Pendaftar</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="2" class="px-6 py-8 text-center text-gray-500 font-medium">Tidak ada data.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- TABEL PENERIMA FINAL -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-600 print-mt-0">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-emerald-50/50">
            <h3 class="text-lg font-bold text-emerald-800 flex items-center">
                <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Daftar Penerima Beasiswa Final
            </h3>
            <span class="text-sm font-bold text-emerald-700 bg-emerald-100/50 px-3 py-1 rounded-lg border border-emerald-200">{{ count($penerima ?? []) }} Mahasiswa</span>
        </div>
        <div class="overflow-x-auto p-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[12px] font-bold text-gray-500 uppercase tracking-wider border-b-2 border-gray-100">
                        <th class="px-6 py-4 w-16 text-center">No</th>
                        <th class="px-6 py-4">Nama Mahasiswa</th>
                        <th class="px-6 py-4 text-center">NIM</th>
                        <th class="px-6 py-4">Prodi / Angkatan</th>
                        <th class="px-6 py-4 text-center">Skor Akhir</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-[14px]">
                    @forelse ($penerima ?? [] as $index => $pengajuan)
                        <tr class="hover:bg-emerald-50/30 transition-colors">
                            <td class="px-6 py-5 text-gray-500 font-bold text-center">{{ $index + 1 }}</td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-800">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <div class="text-sm font-bold text-gray-700">{{ $pengajuan->mahasiswa->nim ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-gray-700">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                <div class="text-xs text-gray-500 font-medium mt-0.5">Angkatan {{ $pengajuan->mahasiswa->angkatan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                <span class="font-black text-emerald-600 bg-emerald-50 px-3 py-1 rounded-md text-sm border border-emerald-100">
                                    {{ $pengajuan->skor_saw ? number_format($pengajuan->skor_saw, 3) : '-' }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500 font-medium">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <p>Belum ada penerima beasiswa yang ditetapkan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
