<x-app-layout>
    <!-- Background Design -->
    <div class="fixed inset-0 z-0 bg-gray-50/50 pointer-events-none"></div>
    <div class="fixed top-0 left-0 w-full h-96 bg-gradient-to-b from-emerald-600/10 to-transparent pointer-events-none z-0"></div>

    <div class="py-12 relative z-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Hero Section -->
            <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                <div class="absolute inset-0 bg-gradient-to-r from-emerald-600 to-emerald-400 opacity-90 z-0"></div>
                
                <!-- Decorative Elements -->
                <div class="absolute -top-24 -right-24 w-96 h-96 bg-white opacity-10 rounded-full blur-3xl pointer-events-none"></div>
                <div class="absolute -bottom-24 -left-24 w-72 h-72 bg-emerald-900 opacity-10 rounded-full blur-2xl pointer-events-none"></div>

                <div class="relative z-10 p-8 sm:p-12 text-white flex flex-col md:flex-row items-center justify-between gap-8">
                    <div class="max-w-2xl">
                        <div class="inline-flex items-center px-3 py-1 rounded-full bg-emerald-500/30 border border-emerald-400/30 text-xs font-semibold tracking-wider uppercase mb-6 backdrop-blur-sm">
                            Informasi Beasiswa
                        </div>
                        <h1 class="text-3xl sm:text-4xl font-bold mb-4">Program Beasiswa Tersedia</h1>
                        <p class="text-emerald-50 text-lg leading-relaxed mb-0">
                            Temukan berbagai program beasiswa yang sedang dibuka. Persiapkan diri Anda dan raih kesempatan untuk mendapatkan dukungan pendidikan terbaik.
                        </p>
                    </div>
                    
                    <div class="hidden md:flex items-center justify-center p-6 bg-white/10 rounded-2xl backdrop-blur-md border border-white/20">
                        <svg class="w-24 h-24 text-white/90 drop-shadow-md" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0112 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/>
                        </svg>
                    </div>
                </div>
            </div>

            <!-- List of Scholarships -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-10 h-10 rounded-xl bg-emerald-100 flex items-center justify-center">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002 2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
                        </svg>
                    </div>
                    <h2 class="text-xl font-bold text-gray-900">Daftar Beasiswa Aktif</h2>
                </div>

                @if($beasiswas->isEmpty())
                    <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center shadow-sm">
                        <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-semibold text-gray-900 mb-2">Belum Ada Beasiswa</h3>
                        <p class="text-gray-500">Saat ini belum ada program beasiswa yang sedang dibuka. Silakan periksa kembali nanti.</p>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($beasiswas as $beasiswa)
                            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden hover:shadow-lg transition-all duration-300 group flex flex-col h-full">
                                <!-- Card Header -->
                                <div class="bg-gray-50 p-6 border-b border-gray-100 flex justify-between items-start">
                                    <div class="w-12 h-12 bg-emerald-100 text-emerald-600 rounded-xl flex items-center justify-center shrink-0 mb-4 group-hover:scale-110 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                                        </svg>
                                    </div>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-emerald-50 text-emerald-700 border border-emerald-200">
                                        Terbuka
                                    </span>
                                </div>
                                
                                <!-- Card Body -->
                                <div class="p-6 flex-1 flex flex-col">
                                    <h3 class="text-xl font-bold text-gray-900 mb-4 line-clamp-2">{{ $beasiswa->nama }}</h3>
                                    
                                    <div class="space-y-3 mb-6 flex-1">
                                        <div class="flex items-center text-sm">
                                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                                            </svg>
                                            <span class="text-gray-600">Kuota: <strong class="text-gray-900">{{ $beasiswa->kuota }} Mahasiswa</strong></span>
                                        </div>
                                        <div class="flex items-center text-sm">
                                            <svg class="w-5 h-5 text-gray-400 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                            </svg>
                                            <span class="text-gray-600">Ditutup: <strong class="text-gray-900">{{ \Carbon\Carbon::parse($beasiswa->deadline)->translatedFormat('d F Y') }}</strong></span>
                                        </div>
                                    </div>
                                    
                                    <!-- Card Footer -->
                                    <div class="pt-4 border-t border-gray-100 mt-auto">
                                        <a href="{{ route('mahasiswa.daftar') }}" class="w-full inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-colors">
                                            Daftar Sekarang
                                            <svg class="ml-2 w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
