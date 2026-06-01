<x-app-layout>
    <!-- Background Decor -->
    <div class="fixed inset-0 z-0 bg-gray-50/50 pointer-events-none"></div>
    <div class="fixed top-0 left-0 w-full h-96 bg-gradient-to-b from-emerald-600/10 to-transparent pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto py-12 relative z-10 px-4 sm:px-6 lg:px-8" x-data="{ search: '' }">
        
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-end justify-between gap-6 mb-8 animate-fade-in">
            <div>
                <div class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-100 text-emerald-700 text-xs font-bold tracking-wider uppercase mb-4">
                    Dashboard Dosen
                </div>
                <h2 class="text-3xl sm:text-4xl font-extrabold text-gray-900 tracking-tight">Mahasiswa Bimbingan</h2>
                <p class="text-gray-500 mt-2 text-lg">Kelola dan pantau proses verifikasi pengajuan beasiswa mahasiswa Anda.</p>
            </div>
            
            <!-- Search Input -->
            <div class="w-full md:w-96">
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-gray-400 group-focus-within:text-emerald-500 transition-colors">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                    </div>
                    <input x-model="search" type="text" class="block w-full pl-10 pr-3 py-3 border border-gray-200 rounded-2xl leading-5 bg-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 sm:text-sm shadow-sm transition-shadow" placeholder="Cari nama atau NIM mahasiswa...">
                </div>
            </div>
        </div>

        <!-- Premium Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-blue-50 rounded-bl-full -mr-8 -mt-8 opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2 relative z-10">Total Mahasiswa</p>
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-14 h-14 bg-blue-100 text-blue-600 rounded-2xl flex items-center justify-center rotate-3 group-hover:rotate-0 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-extrabold text-gray-900">{{ $stats['total'] }}</h3>
                </div>
            </div>
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-amber-50 rounded-bl-full -mr-8 -mt-8 opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2 relative z-10">Menunggu Verifikasi</p>
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-14 h-14 bg-amber-100 text-amber-600 rounded-2xl flex items-center justify-center -rotate-3 group-hover:rotate-0 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-extrabold text-amber-600">{{ $stats['menunggu'] }}</h3>
                </div>
            </div>
            
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 relative overflow-hidden group hover:shadow-md transition-all duration-300">
                <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-bl-full -mr-8 -mt-8 opacity-50 group-hover:scale-110 transition-transform duration-500"></div>
                <p class="text-sm font-bold text-gray-400 uppercase tracking-widest mb-2 relative z-10">Selesai Diverifikasi</p>
                <div class="flex items-center space-x-4 relative z-10">
                    <div class="w-14 h-14 bg-emerald-100 text-emerald-600 rounded-2xl flex items-center justify-center rotate-3 group-hover:rotate-0 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-extrabold text-emerald-600">{{ $stats['sudah_verif'] }}</h3>
                </div>
            </div>
        </div>

        <!-- Main Content Table -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-200">
            <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-800 flex items-center">
                    <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path></svg>
                    Data Mahasiswa Bimbingan
                </h3>
            </div>
            
            <div class="overflow-x-auto">
                @if($mahasiswaList->isEmpty())
                    <div class="text-center py-16">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-gray-100 shadow-inner">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                        </div>
                        <p class="text-gray-500 font-medium text-lg">Belum ada mahasiswa bimbingan yang terdaftar.</p>
                    </div>
                @else
                    <table class="w-full text-left border-collapse whitespace-nowrap">
                        <thead>
                            <tr class="bg-white text-[12px] font-bold text-gray-500 uppercase tracking-widest border-b border-gray-100">
                                <th class="py-5 px-8">Profil Mahasiswa</th>
                                <th class="py-5 px-6">Program Studi</th>
                                <th class="py-5 px-6 text-center">Status Pengajuan</th>
                                <th class="py-5 px-8 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-600 divide-y divide-gray-50">
                            @foreach($mahasiswaList as $mahasiswa)
                                <tr class="hover:bg-gray-50/80 transition-colors group" 
                                    x-data="{ name: '{{ addslashes($mahasiswa->user?->name ?? '') }}', nim: '{{ $mahasiswa->nim }}' }"
                                    x-show="search === '' || name.toLowerCase().includes(search.toLowerCase()) || nim.includes(search)"
                                    x-transition:enter="transition ease-out duration-300"
                                    x-transition:enter-start="opacity-0 transform scale-95"
                                    x-transition:enter-end="opacity-100 transform scale-100"
                                >
                                    <td class="py-5 px-8">
                                        <div class="flex items-center space-x-4">
                                            <div class="relative">
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($mahasiswa->user?->name ?? 'M') }}&color=059669&background=ecfdf5&bold=true" class="w-10 h-10 rounded-full border border-gray-200 group-hover:border-emerald-400 transition-colors">
                                                @if($mahasiswa->pengajuanAktif && $mahasiswa->pengajuanAktif->status === 'menunggu')
                                                    <span class="absolute -top-1 -right-1 w-3 h-3 bg-amber-500 border-2 border-white rounded-full"></span>
                                                @endif
                                            </div>
                                            <div>
                                                <p class="font-bold text-gray-900 group-hover:text-emerald-700 transition-colors">{{ $mahasiswa->user?->name ?? 'Tidak Diketahui' }}</p>
                                                <p class="text-xs text-gray-500 font-mono">{{ $mahasiswa->nim }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-5 px-6">
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            {{ $mahasiswa->prodi }}
                                        </span>
                                    </td>
                                    <td class="py-5 px-6 text-center">
                                        @if($mahasiswa->pengajuanAktif)
                                            @if($mahasiswa->pengajuanAktif->status === 'menunggu')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-amber-50 text-amber-700 border border-amber-200/50 shadow-sm">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                    Menunggu
                                                </span>
                                            @elseif(in_array($mahasiswa->pengajuanAktif->status, ['disetujui', 'diterima', 'dihitung', 'diverifikasi']))
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-200/50 shadow-sm">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                    Diverifikasi
                                                </span>
                                            @elseif($mahasiswa->pengajuanAktif->status === 'ditolak')
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-red-50 text-red-700 border border-red-200/50 shadow-sm">
                                                    <svg class="w-3 h-3 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                    Ditolak
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-700 border border-gray-200/50 shadow-sm">
                                                    {{ ucfirst($mahasiswa->pengajuanAktif->status) }}
                                                </span>
                                            @endif
                                        @else
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-50 text-gray-400 border border-gray-200/50">
                                                Belum Mengajukan
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-5 px-8 text-center">
                                        @if($mahasiswa->pengajuanAktif)
                                            <a href="{{ route('dosen.verifikasi', $mahasiswa->pengajuanAktif->id) }}" class="inline-flex items-center justify-center px-4 py-2 bg-white border border-gray-200 text-gray-700 hover:bg-emerald-50 hover:border-emerald-200 hover:text-emerald-700 font-bold text-xs rounded-xl shadow-sm transition-all focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 group">
                                                <span>{{ $mahasiswa->pengajuanAktif->status === 'menunggu' ? 'Periksa Berkas' : 'Lihat Detail' }}</span>
                                                <svg class="ml-2 w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        @else
                                            <span class="text-gray-300 font-bold text-2xl" title="Belum ada berkas">-</span>
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
                <div class="w-16 h-16 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <p class="text-gray-500 font-medium">Tidak ada mahasiswa yang cocok dengan pencarian "<span x-text="search" class="text-gray-900 font-bold"></span>".</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>