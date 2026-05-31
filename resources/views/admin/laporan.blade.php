<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-serif font-bold text-3xl text-brand-navy leading-tight">
                    {{ __('Laporan & Statistik') }}
                </h2>
                <p class="text-gray-500 mt-1">Laporan komprehensif penerimaan beasiswa akademik.</p>
            </div>
            <button onclick="window.print()" class="inline-flex items-center px-4 py-2 bg-brand-navy border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-brand-navy focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                Cetak Laporan
            </button>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-surface-dim text-brand-navy mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-brand-navy">{{ $totalStats['total_pendaftar'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-status-success bg-opacity-10 text-status-success mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Diterima</p>
                        <p class="text-2xl font-bold text-status-success">{{ $totalStats['total_diterima'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-status-danger bg-opacity-10 text-status-danger mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Ditolak</p>
                        <p class="text-2xl font-bold text-status-danger">{{ $totalStats['total_ditolak'] ?? 0 }}</p>
                    </div>
                </div>
                
                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-brand-teal bg-opacity-10 text-brand-teal mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Rata-rata Skor</p>
                        <p class="text-2xl font-bold text-brand-navy">{{ number_format($totalStats['rata_skor'] ?? 0, 3) }}</p>
                    </div>
                </div>
            </div>

            <!-- DISTRIBUSI GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Prodi -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-surface">
                        <h3 class="text-lg font-semibold text-brand-navy">Penerima Berdasarkan Prodi</h3>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($perProdi ?? [] as $prodi => $stats)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-brand-navy">{{ $prodi ?: 'Tidak Diketahui' }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-status-success font-bold">{{ $stats['diterima'] ?? 0 }}</span>
                                            <span class="text-gray-400 text-xs mx-1">/</span>
                                            <span class="text-gray-500 text-sm">{{ $stats['total'] ?? 0 }} Pendaftar</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-6 text-center text-gray-500 text-sm">Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Angkatan -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-6 py-4 border-b border-gray-100 bg-surface">
                        <h3 class="text-lg font-semibold text-brand-navy">Pendaftar Berdasarkan Angkatan</h3>
                    </div>
                    <div class="p-0">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($perAngkatan ?? [] as $angkatan => $stats)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 text-sm font-medium text-brand-navy">Angkatan {{ $angkatan ?: 'Tidak Diketahui' }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <span class="text-brand-navy font-bold">{{ $stats['total'] ?? 0 }} Pendaftar</span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="px-6 py-6 text-center text-gray-500 text-sm">Tidak ada data.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- TABEL PENERIMA FINAL -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden mt-8">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-status-success bg-opacity-5">
                    <h3 class="text-lg font-semibold text-status-success">Daftar Penerima Beasiswa Final</h3>
                    <span class="text-sm font-medium text-status-success bg-white px-3 py-1 rounded-full shadow-sm">{{ count($penerima ?? []) }} Mahasiswa</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface">
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100 w-16 text-center">No</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Nama Mahasiswa</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">NIM</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Prodi / Angkatan</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Skor Akhir</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($penerima ?? [] as $index => $pengajuan)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-500 text-center">{{ $index + 1 }}</td>
                                    <td class="px-6 py-4">
                                        <div class="font-bold text-brand-navy">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-brand-navy">{{ $pengajuan->mahasiswa->nim ?? '-' }}</td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-brand-navy">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">Angkatan {{ $pengajuan->mahasiswa->angkatan ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-status-success">
                                        {{ $pengajuan->skor_saw ? number_format($pengajuan->skor_saw, 3) : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M12 4v16m8-8H4"></path></svg>
                                        <p class="mt-4 text-sm">Belum ada penerima beasiswa yang ditetapkan.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
