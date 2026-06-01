<x-app-layout>
    <div class="fixed inset-0 z-0 bg-gray-50/50 pointer-events-none"></div>
    <div class="fixed top-0 left-0 w-full h-96 bg-gradient-to-b from-emerald-600/10 to-transparent pointer-events-none z-0"></div>

    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- Header -->
        <div class="mb-8 animate-fade-in flex items-center justify-between">
            <div class="flex items-center">
                <a href="{{ route('dosen.bimbingan') }}" class="mr-5 w-12 h-12 bg-white border border-gray-200 rounded-2xl flex items-center justify-center text-gray-500 hover:text-emerald-600 hover:border-emerald-600 hover:bg-emerald-50 shadow-sm hover:shadow transition-all group">
                    <svg class="w-6 h-6 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                </a>
                <div>
                    <h2 class="text-3xl font-extrabold text-gray-900 tracking-tight">Verifikasi Berkas</h2>
                    <p class="text-gray-500 mt-1">Workspace Verifikasi Dokumen Mahasiswa Bimbingan</p>
                </div>
            </div>
            
            <div class="hidden md:block">
                @if($pengajuan->status == 'menunggu')
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-amber-100 text-amber-800 border border-amber-200 shadow-sm">
                        <span class="w-2.5 h-2.5 rounded-full bg-amber-500 mr-2 animate-pulse"></span>
                        Menunggu Verifikasi
                    </span>
                @else
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-bold bg-emerald-100 text-emerald-800 border border-emerald-200 shadow-sm">
                        <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Telah Diverifikasi
                    </span>
                @endif
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            
            <!-- LEFT COLUMN: Profile & Academic Data (col-span-4) -->
            <div class="lg:col-span-4 space-y-6 animate-slide-up">
                
                <!-- Profile Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden relative">
                    <div class="h-24 bg-gradient-to-r from-emerald-500 to-emerald-400 relative">
                        <div class="absolute inset-0 bg-white/10" style="background-image: radial-gradient(circle at 2px 2px, rgba(255,255,255,0.2) 1px, transparent 0); background-size: 16px 16px;"></div>
                    </div>
                    <div class="px-6 pb-6 pt-0 relative">
                        <div class="flex justify-center -mt-12 mb-4">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($pengajuan->mahasiswa->user?->name ?? 'M') }}&color=059669&background=ecfdf5&bold=true&size=128" class="w-24 h-24 rounded-2xl border-4 border-white shadow-md bg-white">
                        </div>
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $pengajuan->mahasiswa->user?->name ?? 'Tidak Diketahui' }}</h3>
                            <p class="text-sm text-emerald-600 font-mono font-medium mb-3">{{ $pengajuan->mahasiswa->nim }}</p>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-gray-100 text-gray-600 border border-gray-200">
                                {{ $pengajuan->mahasiswa->prodi }}
                            </span>
                        </div>
                    </div>
                </div>

                <!-- Academic Data Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-widest mb-6 flex items-center border-b border-gray-100 pb-3">
                        <svg class="w-5 h-5 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                        Data Akademik
                    </h3>
                    
                    <div class="space-y-5">
                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">IPK Terakhir</p>
                                <p class="text-lg font-bold text-gray-800">{{ $pengajuan->mahasiswa->ipk }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Penghasilan Ortu</p>
                                <p class="text-base font-bold text-gray-800">Rp {{ number_format($pengajuan->mahasiswa->penghasilan_ortu, 0, ',', '.') }}</p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-amber-100 text-amber-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Skor Prestasi</p>
                                <p class="text-lg font-bold text-gray-800">{{ $pengajuan->mahasiswa->prestasi }}<span class="text-sm font-normal text-gray-500">/100</span></p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path></svg>
                            </div>
                        </div>

                        <div class="flex justify-between items-center bg-gray-50 p-3 rounded-xl">
                            <div>
                                <p class="text-[10px] font-bold text-gray-400 uppercase">Skor Organisasi</p>
                                <p class="text-lg font-bold text-gray-800">{{ $pengajuan->mahasiswa->keaktifan_org }}<span class="text-sm font-normal text-gray-500">/100</span></p>
                            </div>
                            <div class="w-10 h-10 rounded-full bg-rose-100 text-rose-600 flex items-center justify-center">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Documents & Form (col-span-8) -->
            <div class="lg:col-span-8 space-y-6 animate-slide-up delay-100">
                
                <!-- Documents Card -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Lampiran Dokumen
                    </h3>
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach([
                            'dokumen_ktp' => ['KTP', 'Identitas diri mahasiswa', 'blue'], 
                            'dokumen_kk' => ['Kartu Keluarga', 'Bukti susunan keluarga', 'amber'], 
                            'dokumen_sktm' => ['SKTM / Slip Gaji', 'Bukti kondisi ekonomi', 'emerald'], 
                            'dokumen_transkrip' => ['Transkrip Nilai', 'Bukti prestasi akademik', 'purple'], 
                            'dokumen_prestasi' => ['Sertifikat Prestasi', 'Dokumen pendukung opsional', 'rose']
                        ] as $field => $info)
                            @if($pengajuan->$field)
                                <a href="{{ Storage::url($pengajuan->$field) }}" target="_blank" class="flex flex-col p-5 border border-gray-200 rounded-2xl hover:border-{{ $info[2] }}-400 hover:shadow-md transition-all group relative overflow-hidden bg-white">
                                    <div class="absolute -right-4 -bottom-4 w-24 h-24 bg-{{ $info[2] }}-50 rounded-full opacity-50 group-hover:scale-150 transition-transform duration-500"></div>
                                    
                                    <div class="flex items-start justify-between relative z-10 mb-4">
                                        <div class="w-12 h-12 rounded-xl bg-{{ $info[2] }}-100 text-{{ $info[2] }}-600 flex items-center justify-center shrink-0 group-hover:-translate-y-1 transition-transform">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                                        </div>
                                        <div class="w-8 h-8 rounded-full bg-gray-50 flex items-center justify-center text-gray-400 group-hover:text-{{ $info[2] }}-600 group-hover:bg-{{ $info[2] }}-100 transition-colors">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        </div>
                                    </div>
                                    <div class="relative z-10">
                                        <h4 class="text-base font-bold text-gray-900 group-hover:text-{{ $info[2] }}-700 transition-colors">{{ $info[0] }}</h4>
                                        <p class="text-xs text-gray-500 mt-1">{{ $info[1] }}</p>
                                    </div>
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- Form Verifikasi -->
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8" x-data="{ decision: '{{ old('keputusan') }}' }">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center">
                        <svg class="w-6 h-6 text-emerald-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tindakan Verifikasi
                    </h3>

                    @if($pengajuan->status == 'menunggu')
                        <form method="POST" action="{{ route('dosen.verifikasi.proses', $pengajuan->id) }}">
                            @csrf
                            <div class="space-y-8">
                                <!-- Keputusan -->
                                <div>
                                    <p class="text-sm font-bold text-gray-700 mb-4">Keputusan Final <span class="text-red-500">*</span></p>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                        <label class="cursor-pointer">
                                            <input type="radio" name="keputusan" value="setuju" class="peer sr-only" x-model="decision" />
                                            <div class="rounded-2xl border-2 border-gray-200 p-5 text-center peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 transition-all">
                                                <div class="w-12 h-12 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mx-auto mb-3 text-gray-400 peer-checked:text-emerald-500 peer-checked:border-emerald-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                </div>
                                                <p class="text-base font-bold text-gray-900">Setujui Pengajuan</p>
                                                <p class="text-xs text-gray-500 mt-1">Lanjutkan ke proses admin</p>
                                            </div>
                                        </label>
                                        
                                        <label class="cursor-pointer">
                                            <input type="radio" name="keputusan" value="tolak" class="peer sr-only" x-model="decision" />
                                            <div class="rounded-2xl border-2 border-gray-200 p-5 text-center peer-checked:border-red-500 peer-checked:bg-red-50 hover:border-red-300 transition-all">
                                                <div class="w-12 h-12 rounded-full bg-white border border-gray-200 shadow-sm flex items-center justify-center mx-auto mb-3 text-gray-400 peer-checked:text-red-500 peer-checked:border-red-500">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                                </div>
                                                <p class="text-base font-bold text-gray-900">Tolak Pengajuan</p>
                                                <p class="text-xs text-gray-500 mt-1">Hentikan proses beasiswa</p>
                                            </div>
                                        </label>
                                    </div>
                                    @error('keputusan') <p class="text-xs text-red-600 mt-2 font-medium bg-red-50 p-2 rounded">{{ $message }}</p> @enderror
                                </div>

                                <!-- Catatan (Conditionally Highlighted if Rejected) -->
                                <div class="bg-gray-50 p-5 rounded-2xl border border-gray-100" :class="{ 'border-red-200 bg-red-50/50': decision === 'tolak' }">
                                    <label class="block mb-2 text-sm font-bold text-gray-800">
                                        Catatan / Evaluasi 
                                        <span x-show="decision === 'tolak'" class="text-red-500 text-xs ml-1">(Wajib jika menolak)</span>
                                        <span x-show="decision !== 'tolak'" class="text-gray-400 text-xs font-normal ml-1">(Opsional)</span>
                                    </label>
                                    <textarea name="catatan_dosen" rows="4" 
                                        class="w-full rounded-xl border-gray-300 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-colors resize-none" 
                                        placeholder="Berikan catatan perbaikan, alasan penolakan, atau rekomendasi khusus..."
                                    >{{ old('catatan_dosen', $pengajuan->catatan_dosen) }}</textarea>
                                    @error('catatan_dosen') <p class="text-xs text-red-600 mt-2 font-medium">{{ $message }}</p> @enderror
                                </div>

                                <div class="pt-2 flex justify-end">
                                    <button type="submit" class="inline-flex items-center justify-center px-8 py-3.5 border border-transparent text-sm font-bold rounded-xl text-white bg-emerald-600 hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-emerald-500 shadow-md hover:shadow-lg transform hover:-translate-y-0.5 transition-all">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                                        Simpan & Proses Verifikasi
                                    </button>
                                </div>
                            </div>
                        </form>
                    @else
                        <!-- Readonly State -->
                        <div class="bg-gray-50 border border-gray-200 rounded-2xl p-6">
                            <div class="flex items-start">
                                <div class="w-12 h-12 rounded-full {{ $pengajuan->status == 'ditolak' ? 'bg-red-100 text-red-600' : 'bg-emerald-100 text-emerald-600' }} flex items-center justify-center shrink-0 mr-4">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        @if($pengajuan->status == 'ditolak')
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                        @else
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        @endif
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-base font-bold text-gray-900 mb-1">
                                        Pengajuan ini telah {{ $pengajuan->status == 'ditolak' ? 'Ditolak' : 'Disetujui' }}
                                    </h4>
                                    <p class="text-xs text-gray-500 mb-4">Pada {{ \Carbon\Carbon::parse($pengajuan->diverifikasi_at)->translatedFormat('d F Y, H:i') }}</p>
                                    
                                    @if($pengajuan->catatan_dosen)
                                        <div class="bg-white border border-gray-200 rounded-xl p-4 mt-2 relative">
                                            <div class="absolute -top-2 left-4 w-4 h-4 bg-white border-t border-l border-gray-200 rotate-45"></div>
                                            <p class="text-sm text-gray-700 italic relative z-10">"{{ $pengajuan->catatan_dosen }}"</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>