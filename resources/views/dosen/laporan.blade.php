<x-app-layout>
    <div class="fixed inset-0 z-0 bg-gray-50/50 pointer-events-none"></div>
    <div class="fixed top-0 left-0 w-full h-96 bg-gradient-to-b from-blue-600/10 to-transparent pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10" x-data="{ search: '' }">
        <!-- Header -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 animate-fade-in">
            <div>
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-blue-100 text-blue-700 text-xs font-bold tracking-wider uppercase mb-4">
                    Executive Summary
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Laporan Mahasiswa</h2>
                <p class="text-gray-500 mt-2 text-lg">Rekapitulasi akhir skor SAW dan status kelulusan mahasiswa bimbingan Anda.</p>
            </div>
            
            <div class="w-full md:w-80">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-blue-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input x-model="search" type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500 sm:text-sm shadow-sm transition-shadow" placeholder="Cari nama atau NIM...">
                </div>
            </div>
        </div>

        @php
            $totalMhs = $mahasiswaList->count();
            $diterima = 0;
            $ditolak = 0;
            $belumDinilai = 0;

            foreach($mahasiswaList as $mhs) {
                $p = $mhs->pengajuan->first();
                if ($p) {
                    if ($p->status == 'diterima') $diterima++;
                    elseif ($p->status == 'ditolak') $ditolak++;
                    else $belumDinilai++;
                } else {
                    $belumDinilai++;
                }
            }
        @endphp

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-gray-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Total Bimbingan</p>
                    <h3 class="text-3xl font-extrabold text-gray-900">{{ $totalMhs }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Lolos Beasiswa</p>
                    <h3 class="text-3xl font-extrabold text-emerald-600">{{ $diterima }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-red-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Ditolak</p>
                    <h3 class="text-3xl font-extrabold text-red-600">{{ $ditolak }}</h3>
                </div>
            </div>
            <div class="bg-white rounded-3xl p-6 border border-gray-100 shadow-sm relative overflow-hidden group hover:shadow-md transition-all">
                <div class="absolute -right-6 -top-6 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-1">Dalam Proses</p>
                    <h3 class="text-3xl font-extrabold text-blue-600">{{ $belumDinilai }}</h3>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-200">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex justify-between items-center">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-blue-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Data Rekapitulasi Mahasiswa
                </h3>
                <button onclick="window.print()" class="hidden md:flex items-center text-sm text-gray-500 hover:text-blue-600 font-medium transition-colors">
                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Cetak Halaman
                </button>
            </div>
            
            <div class="overflow-x-auto">
                @if($mahasiswaList->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 shadow-inner">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium text-lg">Belum ada data laporan mahasiswa untuk bimbingan Anda.</p>
                    </div>
                @else
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-white text-[12px] font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">
                                <th class="py-5 px-8">Nama & NIM</th>
                                <th class="py-5 px-6 text-center">Status Akhir</th>
                                <th class="py-5 px-6 text-center">Skor Algoritma SAW</th>
                                <th class="py-5 px-8 text-center">Peringkat</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                            @foreach($mahasiswaList as $mahasiswa)
                                @php $pengajuan = $mahasiswa->pengajuan->first(); @endphp
                                <tr class="hover:bg-blue-50/30 transition-colors"
                                    x-data="{ name: '{{ addslashes($mahasiswa->user?->name ?? '') }}', nim: '{{ $mahasiswa->nim }}' }"
                                    x-show="search === '' || name.toLowerCase().includes(search.toLowerCase()) || nim.includes(search)"
                                >
                                    <td class="py-5 px-8">
                                        <div class="flex items-center space-x-3">
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-100 to-indigo-100 text-blue-700 font-bold flex items-center justify-center border border-white shadow-sm">
                                                {{ substr($mahasiswa->user?->name ?? 'M', 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $mahasiswa->user?->name ?? 'Tidak Diketahui' }}</p>
                                                <p class="text-xs text-gray-500 font-mono">{{ $mahasiswa->nim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        @if($pengajuan)
                                            @if($pengajuan->status == 'diterima')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    Diterima
                                                </span>
                                            @elseif($pengajuan->status == 'ditolak')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-blue-50 text-blue-700 border border-blue-200">
                                                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-1.5 animate-pulse"></span>
                                                    Sedang Diproses
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-400 border border-gray-200">
                                                Belum Mengajukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        @if($pengajuan?->skor_saw !== null)
                                            <div class="inline-flex items-baseline">
                                                <span class="text-xl font-extrabold text-gray-900">{{ number_format($pengajuan->skor_saw, 3) }}</span>
                                            </div>
                                            <!-- Visual bar -->
                                            <div class="w-24 h-1.5 bg-gray-100 rounded-full mt-1 mx-auto overflow-hidden">
                                                <div class="h-full bg-blue-500 rounded-full" style="width: {{ min(100, $pengajuan->skor_saw * 100) }}%"></div>
                                            </div>
                                        @else
                                            <span class="text-gray-300 font-bold">-</span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-8 text-center">
                                        @if($pengajuan?->rank)
                                            @if($pengajuan->rank <= 3)
                                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-600 font-extrabold text-sm border border-amber-200 shadow-sm" title="Top 3">
                                                    #{{ $pengajuan->rank }}
                                                </div>
                                            @else
                                                <div class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gray-50 text-gray-600 font-bold text-sm border border-gray-200">
                                                    #{{ $pengajuan->rank }}
                                                </div>
                                            @endif
                                        @else
                                            <span class="text-gray-300 font-bold">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>

            @if($mahasiswaList->isNotEmpty())
            <!-- Empty state for search -->
            <div x-show="[...document.querySelectorAll('tbody tr')].every(row => row.style.display === 'none')" style="display: none;" class="text-center py-16">
                <p class="text-gray-500 font-medium">Tidak ada mahasiswa yang cocok dengan pencarian "<span x-text="search" class="text-gray-900 font-bold"></span>".</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>