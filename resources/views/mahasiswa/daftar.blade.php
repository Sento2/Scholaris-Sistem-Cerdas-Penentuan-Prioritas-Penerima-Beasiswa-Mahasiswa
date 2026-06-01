<x-app-layout>
<div class="max-w-4xl mx-auto space-y-6">

    {{-- ============================================================
         PAGE HEADER
    ============================================================ --}}
    <div class="animate-fade-in">
        <div class="flex items-center gap-3">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="w-8 h-8 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-all shadow-sm flex-shrink-0">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800">Pendaftaran Beasiswa</h1>
                <p class="text-sm text-gray-500">Lengkapi semua data dan unggah dokumen persyaratan</p>
            </div>
        </div>
    </div>

    {{-- Info Banner --}}
    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-start gap-3 animate-slide-up">
        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-emerald-800">Pastikan data yang Anda masukkan akurat</p>
            <p class="text-xs text-emerald-700 mt-0.5">Data ini akan digunakan dalam proses seleksi menggunakan metode SAW. Data yang tidak sesuai dokumen dapat menyebabkan pengajuan ditolak.</p>
        </div>
    </div>

    {{-- Validation Errors --}}
    @if($errors->any())
    <div class="bg-red-50 border border-red-200 rounded-xl p-4 flex items-start gap-3 animate-slide-up">
        <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-red-800 mb-1">Terdapat kesalahan pada form:</p>
            <ul class="text-xs text-red-700 space-y-0.5 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    @if($pengajuanAktif ?? false)
        <div class="bg-white rounded-3xl p-10 text-center shadow-sm border border-gray-100 animate-slide-up mt-8">
            <div class="w-20 h-20 bg-emerald-100 text-emerald-600 rounded-full flex items-center justify-center mx-auto mb-5">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 mb-2">Anda Sudah Terdaftar!</h2>
            <p class="text-gray-500 mb-8 max-w-md mx-auto">Pengajuan beasiswa Anda saat ini sedang dalam proses. Anda tidak perlu mendaftar ulang. Silakan cek menu Status Pengajuan untuk memantau perkembangannya.</p>
            <a href="{{ route('mahasiswa.status') }}" class="inline-flex items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold shadow-sm hover:bg-emerald-700 transition-colors">
                Lihat Status Pengajuan
            </a>
        </div>
    @else
    <form method="POST" action="{{ route('mahasiswa.daftar.simpan') }}" enctype="multipart/form-data" class="space-y-6">
        @csrf

        {{-- ============================================================
             SECTION 1: DATA DIRI & AKADEMIK
        ============================================================ --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-slide-up delay-100">
            <div class="px-6 md:px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-800">Data Diri & Akademik</h2>
                    <p class="text-xs text-gray-400">NIM, program studi, kontak, dan alamat</p>
                </div>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- NIM --}}
                <div>
                    <label for="nim" class="block text-sm font-bold text-gray-700 mb-2">
                        NIM <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"/></svg>
                        </div>
                        <input id="nim" name="nim" type="text"
                            value="{{ old('nim', $mahasiswa?->nim) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm font-mono"
                            placeholder="Contoh: 20210001">
                    </div>
                    @error('nim') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Program Studi --}}
                <div>
                    <label for="prodi" class="block text-sm font-bold text-gray-700 mb-2">
                        Program Studi <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <input id="prodi" name="prodi" type="text"
                            value="{{ old('prodi', $mahasiswa?->prodi) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Contoh: Teknik Informatika">
                    </div>
                    @error('prodi') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Angkatan --}}
                <div>
                    <label for="angkatan" class="block text-sm font-bold text-gray-700 mb-2">
                        Tahun Angkatan <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                        </div>
                        <input id="angkatan" name="angkatan" type="number"
                            value="{{ old('angkatan', $mahasiswa?->angkatan) }}"
                            min="2000" max="2099"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Contoh: 2021">
                    </div>
                    @error('angkatan') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- No. HP --}}
                <div>
                    <label for="no_hp" class="block text-sm font-bold text-gray-700 mb-2">
                        No. WhatsApp <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                        </div>
                        <input id="no_hp" name="no_hp" type="text"
                            value="{{ old('no_hp', $mahasiswa?->no_hp) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Contoh: 081234567890">
                    </div>
                    @error('no_hp') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Alamat --}}
                <div class="md:col-span-2">
                    <label for="alamat" class="block text-sm font-bold text-gray-700 mb-2">
                        Alamat Lengkap <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-3.5 left-0 pl-3.5 flex pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <textarea id="alamat" name="alamat" rows="3"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="RT/RW, Desa/Kelurahan, Kecamatan, Kabupaten/Kota">{{ old('alamat', $mahasiswa?->alamat) }}</textarea>
                    </div>
                    @error('alamat') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ============================================================
             SECTION 2: KRITERIA BEASISWA
        ============================================================ --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-slide-up delay-200">
            <div class="px-6 md:px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-800">Kriteria Penilaian Beasiswa</h2>
                    <p class="text-xs text-gray-400">Data ini digunakan dalam perhitungan SAW</p>
                </div>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-5">

                {{-- Penghasilan Ortu --}}
                <div>
                    <label for="penghasilan_ortu" class="block text-sm font-bold text-gray-700 mb-2">
                        Penghasilan Orang Tua / Bulan (Rp) <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <span class="text-gray-400 text-sm font-bold">Rp</span>
                        </div>
                        <input id="penghasilan_ortu" name="penghasilan_ortu" type="number" min="0"
                            value="{{ old('penghasilan_ortu', $mahasiswa?->penghasilan_ortu) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Contoh: 3000000">
                    </div>
                    @error('penghasilan_ortu') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- IPK --}}
                <div>
                    <label for="ipk" class="block text-sm font-bold text-gray-700 mb-2">
                        IPK Terakhir <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                        </div>
                        <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4"
                            value="{{ old('ipk', $mahasiswa?->ipk) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Contoh: 3.75">
                    </div>
                    @error('ipk') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Prestasi --}}
                <div>
                    <label for="prestasi" class="block text-sm font-bold text-gray-700 mb-2">
                        Skor Prestasi <span class="text-red-500">*</span>
                        <span class="font-normal text-gray-400">(0–100)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                        </div>
                        <input id="prestasi" name="prestasi" type="number" step="0.01" min="0" max="100"
                            value="{{ old('prestasi', $mahasiswa?->prestasi) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Masukkan angka 0–100">
                    </div>
                    <p class="text-[11px] text-gray-400 mt-1.5">Skor prestasi akademik/non-akademik sesuai standar penilaian fakultas.</p>
                    @error('prestasi') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>

                {{-- Keaktifan --}}
                <div>
                    <label for="keaktifan_org" class="block text-sm font-bold text-gray-700 mb-2">
                        Skor Keaktifan Organisasi <span class="text-red-500">*</span>
                        <span class="font-normal text-gray-400">(0–100)</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <input id="keaktifan_org" name="keaktifan_org" type="number" step="0.01" min="0" max="100"
                            value="{{ old('keaktifan_org', $mahasiswa?->keaktifan_org) }}"
                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                            placeholder="Masukkan angka 0–100">
                    </div>
                    <p class="text-[11px] text-gray-400 mt-1.5">Skor keaktifan dalam organisasi kemahasiswaan/kegiatan kampus.</p>
                    @error('keaktifan_org') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ============================================================
             SECTION 3: DOKUMEN PERSYARATAN
        ============================================================ --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-slide-up delay-300">
            <div class="px-6 md:px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                </div>
                <div>
                    <h2 class="text-sm font-bold text-gray-800">Dokumen Persyaratan</h2>
                    <p class="text-xs text-gray-400">Format PDF, JPG, atau PNG. Maksimum 2MB per file.</p>
                </div>
            </div>

            <div class="p-6 md:p-8 grid grid-cols-1 md:grid-cols-2 gap-5">

                @php
                    $dokFields = [
                        ['name' => 'dokumen_ktp',       'label' => 'KTP (Kartu Tanda Penduduk)',          'required' => true],
                        ['name' => 'dokumen_kk',        'label' => 'Kartu Keluarga (KK)',                  'required' => true],
                        ['name' => 'dokumen_sktm',      'label' => 'SKTM / Slip Gaji Orang Tua',           'required' => true],
                        ['name' => 'dokumen_transkrip', 'label' => 'Transkrip Nilai Terakhir',             'required' => true],
                    ];
                @endphp

                @foreach($dokFields as $doc)
                <div>
                    <label for="{{ $doc['name'] }}" class="block text-sm font-bold text-gray-700 mb-2">
                        {{ $doc['label'] }}
                        @if($doc['required'])<span class="text-red-500">*</span>@endif
                    </label>
                    <div class="relative border border-gray-200 rounded-xl bg-gray-50/50 hover:bg-gray-50 transition-colors overflow-hidden">
                        <input id="{{ $doc['name'] }}" name="{{ $doc['name'] }}" type="file"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-4 file:border-0 file:bg-emerald-50 file:text-emerald-700 file:font-bold file:text-xs hover:file:bg-emerald-100 file:cursor-pointer cursor-pointer">
                    </div>
                    @error($doc['name']) <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
                @endforeach

                {{-- Sertifikat Prestasi (opsional) --}}
                <div class="md:col-span-2">
                    <label for="dokumen_prestasi" class="block text-sm font-bold text-gray-700 mb-2">
                        Sertifikat Prestasi
                        <span class="font-normal text-gray-400 text-xs ml-1">(Opsional)</span>
                    </label>
                    <div class="relative border border-dashed border-gray-200 rounded-xl bg-gray-50/50 hover:bg-gray-50 transition-colors overflow-hidden">
                        <input id="dokumen_prestasi" name="dokumen_prestasi" type="file"
                            accept=".pdf,.jpg,.jpeg,.png"
                            class="w-full text-sm text-gray-600 file:mr-4 file:py-3 file:px-4 file:border-0 file:bg-gray-100 file:text-gray-600 file:font-bold file:text-xs hover:file:bg-gray-200 file:cursor-pointer cursor-pointer">
                    </div>
                    <p class="text-[11px] text-gray-400 mt-1.5">Lampirkan sertifikat yang mendukung penilaian. Format PDF/JPG/PNG, maks. 2MB.</p>
                    @error('dokumen_prestasi') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        {{-- ============================================================
             SUBMIT BUTTON
        ============================================================ --}}
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm flex flex-col sm:flex-row items-center justify-between gap-4 animate-slide-up delay-400">
            <div class="flex items-center gap-2 text-sm text-gray-500">
                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                Data Anda terproteksi dan hanya digunakan untuk proses seleksi.
            </div>
            <div class="flex gap-3 w-full sm:w-auto">
                <a href="{{ route('mahasiswa.dashboard') }}"
                   class="flex-1 sm:flex-initial px-6 py-3 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 transition-all text-center">
                    Batalkan
                </a>
                <button type="submit"
                    class="flex-1 sm:flex-initial flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3 rounded-xl font-bold shadow-sm hover:shadow-md transition-all transform hover:-translate-y-0.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/></svg>
                    Kirim Pengajuan
                </button>
            </div>
        </div>

    </form>
    @endif
</div>
</x-app-layout>