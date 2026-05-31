<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-3xl text-brand-navy leading-tight">
            {{ __('Dashboard Admin Jurusan') }}
        </h2>
        <p class="text-gray-500 mt-1">Ringkasan seleksi beasiswa akademik (Metode SAW)</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- STATS CARDS -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-surface-dim text-brand-navy mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Total Pendaftar</p>
                        <p class="text-2xl font-bold text-brand-navy">{{ $stats['total_pendaftar'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-status-warning bg-opacity-20 text-status-warning mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Menunggu Verifikasi</p>
                        <p class="text-2xl font-bold text-brand-navy">{{ $stats['menunggu_verif'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-brand-teal bg-opacity-20 text-brand-teal mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Sudah Dihitung</p>
                        <p class="text-2xl font-bold text-brand-navy">{{ $stats['sudah_dihitung'] ?? 0 }}</p>
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="bg-white rounded-xl shadow-sm p-6 border border-gray-100 flex items-center">
                    <div class="p-3 rounded-lg bg-status-success bg-opacity-20 text-status-success mr-4">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <div>
                        <p class="text-sm font-medium text-gray-500">Penerima Beasiswa</p>
                        <p class="text-2xl font-bold text-brand-navy">{{ $stats['diterima'] ?? 0 }}</p>
                    </div>
                </div>
            </div>

            <!-- MAIN CONTENT AREA -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- TOP 5 RANKING -->
                <div class="lg:col-span-2 bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                        <h3 class="text-lg font-semibold text-brand-navy">Top 5 Ranking SAW</h3>
                        <a href="{{ route('admin.ranking') }}" class="text-sm text-brand-teal hover:underline font-medium">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-surface">
                                    <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Peringkat</th>
                                    <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Mahasiswa</th>
                                    <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Skor Akhir</th>
                                    <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @forelse ($topRanking ?? [] as $index => $pengajuan)
                                    <tr class="hover:bg-gray-50 transition {{ $index < 3 ? 'bg-brand-teal bg-opacity-5' : '' }}">
                                        <td class="px-6 py-4 font-bold text-brand-navy text-lg">#{{ $pengajuan->rank }}</td>
                                        <td class="px-6 py-4">
                                            <div class="font-medium text-brand-navy">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                                            <div class="text-sm text-gray-500">{{ $pengajuan->mahasiswa->nim ?? '-' }} &middot; {{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center">
                                                <span class="font-bold text-brand-navy w-12">{{ number_format($pengajuan->skor_saw ?? 0, 3) }}</span>
                                                <div class="w-24 bg-gray-200 rounded-full h-2 ml-2">
                                                    <div class="bg-brand-teal h-2 rounded-full" style="width: {{ ($pengajuan->skor_saw ?? 0) * 100 }}%"></div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($pengajuan->status == 'diterima')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-success bg-opacity-10 text-status-success">
                                                    Diterima
                                                </span>
                                            @elseif($pengajuan->status == 'ditolak')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-danger bg-opacity-10 text-status-danger">
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-warning bg-opacity-10 text-status-warning">
                                                    {{ ucfirst($pengajuan->status) }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-gray-500">
                                            Belum ada data ranking. Silakan lakukan perhitungan SAW.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- AKTIVITAS TERBARU -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100">
                    <div class="px-6 py-5 border-b border-gray-100">
                        <h3 class="text-lg font-semibold text-brand-navy">Aktivitas Pengajuan</h3>
                    </div>
                    <div class="p-6">
                        <div class="flow-root">
                            <ul role="list" class="-mb-8">
                                @forelse ($aktivitasTerbaru ?? [] as $index => $aktif)
                                    <li>
                                        <div class="relative pb-8">
                                            @if($index !== count($aktivitasTerbaru) - 1)
                                                <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200" aria-hidden="true"></span>
                                            @endif
                                            <div class="relative flex space-x-3">
                                                <div>
                                                    <span class="h-8 w-8 rounded-full bg-surface-dim flex items-center justify-center ring-8 ring-white">
                                                        <svg class="h-4 w-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                                                    </span>
                                                </div>
                                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                                    <div>
                                                        <p class="text-sm text-gray-500">
                                                            <span class="font-medium text-brand-navy">{{ $aktif->mahasiswa->user->name ?? 'Mahasiswa' }}</span> 
                                                            mengajukan beasiswa.
                                                        </p>
                                                    </div>
                                                    <div class="text-right text-xs whitespace-nowrap text-gray-500">
                                                        {{ $aktif->created_at ? $aktif->created_at->diffForHumans() : '-' }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <div class="text-center text-sm text-gray-500 py-4">Belum ada aktivitas.</div>
                                @endforelse
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
