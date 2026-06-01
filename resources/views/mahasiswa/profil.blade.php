<x-app-layout>
    <div class="max-w-5xl mx-auto" x-data="profilMahasiswa()">

        {{-- ===================== HEADER PROFIL ===================== --}}
        <div class="relative bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 rounded-2xl p-8 mb-8 shadow-lg overflow-hidden animate-fade-in">
            {{-- Decorative circles --}}
            <div class="absolute -top-10 -right-10 w-48 h-48 bg-white/5 rounded-full"></div>
            <div class="absolute -bottom-8 -left-8 w-36 h-36 bg-white/5 rounded-full"></div>

            <div class="relative flex flex-col sm:flex-row items-center sm:items-start gap-6">
                {{-- Avatar --}}
                <div class="relative group flex-shrink-0">
                    <div class="w-24 h-24 rounded-2xl bg-white/20 border-2 border-white/30 flex items-center justify-center overflow-hidden shadow-xl">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=ffffff&background=059669&size=192&bold=true"
                             alt="Avatar {{ $user->name }}"
                             class="w-full h-full object-cover">
                    </div>
                    <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-emerald-400 border-2 border-white rounded-full"></div>
                </div>

                {{-- Info utama --}}
                <div class="text-center sm:text-left flex-1">
                    <h1 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">{{ $user->name }}</h1>
                    <p class="text-emerald-200 mt-1 text-sm font-medium">{{ $user->email }}</p>
                    <div class="flex flex-wrap justify-center sm:justify-start gap-2 mt-4">
                        @if($mahasiswa?->nim)
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-bold px-3 py-1.5 rounded-lg border border-white/20">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V8a2 2 0 00-2-2h-5m-4 0V5a2 2 0 114 0v1m-4 0a2 2 0 104 0m-5 8a2 2 0 100-4 2 2 0 000 4zm0 0c1.306 0 2.417.835 2.83 2M9 14a3.001 3.001 0 00-2.83 2M15 11h3m-3 4h2"/></svg>
                                NIM: {{ $mahasiswa->nim }}
                            </span>
                        @endif
                        @if($mahasiswa?->prodi)
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-bold px-3 py-1.5 rounded-lg border border-white/20">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14zm-4 6v-7.5l4-2.222"/></svg>
                                {{ $mahasiswa->prodi }}
                            </span>
                        @endif
                        @if($mahasiswa?->angkatan)
                            <span class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-bold px-3 py-1.5 rounded-lg border border-white/20">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                Angkatan {{ $mahasiswa->angkatan }}
                            </span>
                        @endif
                        <span class="inline-flex items-center gap-1.5 bg-emerald-400/30 text-emerald-100 text-xs font-bold px-3 py-1.5 rounded-lg border border-emerald-400/30">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            Mahasiswa Aktif
                        </span>
                    </div>
                </div>

                {{-- IPK Badge --}}
                @if($mahasiswa?->ipk)
                <div class="flex-shrink-0 bg-white/10 border border-white/20 rounded-2xl px-6 py-4 text-center">
                    <p class="text-emerald-200 text-xs font-bold uppercase tracking-widest mb-1">IPK</p>
                    <p class="text-4xl font-extrabold text-white">{{ number_format($mahasiswa->ipk, 2) }}</p>
                    <div class="w-full bg-white/20 rounded-full h-1.5 mt-2">
                        <div class="bg-emerald-300 h-1.5 rounded-full" style="width: {{ ($mahasiswa->ipk / 4) * 100 }}%"></div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        {{-- ===================== FLASH MESSAGES ===================== --}}
        @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl p-4 flex items-center gap-3 animate-slide-up shadow-sm">
            <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
            </div>
            <p class="text-sm font-semibold">{{ session('success') }}</p>
        </div>
        @endif

        @if($errors->any())
        <div class="mb-6 bg-red-50 border border-red-200 text-red-800 rounded-xl p-4 flex items-start gap-3 animate-slide-up shadow-sm">
            <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center flex-shrink-0 mt-0.5">
                <svg class="w-4 h-4 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <div>
                <p class="text-sm font-bold mb-1">Terdapat kesalahan pada form:</p>
                <ul class="text-xs space-y-0.5 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
        @endif

        {{-- ===================== FORM EDIT PROFIL ===================== --}}
        <form method="POST" action="{{ route('mahasiswa.profil.update') }}" id="form-profil">
            @csrf
            @method('PATCH')

            {{-- -------- TAB NAVIGATION -------- --}}
            <div class="flex items-center gap-2 mb-6 bg-white border border-gray-100 rounded-xl p-1.5 shadow-sm overflow-x-auto">
                <button type="button" @click="activeTab = 'akun'"
                    :class="activeTab === 'akun' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                    Data Diri
                </button>
                <button type="button" @click="activeTab = 'akademik'"
                    :class="activeTab === 'akademik' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                    Data Akademik
                </button>
                <button type="button" @click="activeTab = 'keluarga'"
                    :class="activeTab === 'keluarga' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Data Keluarga
                </button>
                <button type="button" @click="activeTab = 'beasiswa'"
                    :class="activeTab === 'beasiswa' ? 'bg-emerald-600 text-white shadow-sm' : 'text-gray-500 hover:text-gray-700 hover:bg-gray-50'"
                    class="flex items-center gap-2 px-4 py-2.5 rounded-lg text-sm font-bold transition-all whitespace-nowrap">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                    Kriteria Beasiswa
                </button>
            </div>

            {{-- ========== TAB: DATA DIRI ========== --}}
            <div x-show="activeTab === 'akun'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0">
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    {{-- Section header --}}
                    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-9 h-9 bg-emerald-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-800">Informasi Akun & Data Diri</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Nama lengkap, email, dan kontak pribadi</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                            {{-- Nama Lengkap --}}
                            <div>
                                <label for="name" class="block text-sm font-bold text-gray-700 mb-2">
                                    Nama Lengkap <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <input id="name" name="name" type="text"
                                        value="{{ old('name', $user->name) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="Masukkan nama lengkap Anda">
                                </div>
                                @error('name') <p class="text-xs text-red-600 mt-1.5 font-medium flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>{{ $message }}</p> @enderror
                            </div>

                            {{-- Email (readonly) --}}
                            <div>
                                <label class="block text-sm font-bold text-gray-700 mb-2">Email Akun</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/></svg>
                                    </div>
                                    <input type="email" value="{{ $user->email }}" readonly
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-100 bg-gray-100 text-gray-500 text-sm cursor-not-allowed">
                                </div>
                                <p class="text-[11px] text-gray-400 mt-1.5">Email tidak dapat diubah di sini.</p>
                            </div>

                            {{-- No. HP --}}
                            <div>
                                <label for="no_hp" class="block text-sm font-bold text-gray-700 mb-2">No. WhatsApp</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <input id="no_hp" name="no_hp" type="text"
                                        value="{{ old('no_hp', $mahasiswa?->no_hp) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="Contoh: 081234567890">
                                </div>
                                @error('no_hp') <p class="text-xs text-red-600 mt-1.5 font-medium flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>{{ $message }}</p> @enderror
                            </div>

                            {{-- Alamat --}}
                            <div class="md:col-span-2">
                                <label for="alamat" class="block text-sm font-bold text-gray-700 mb-2">Alamat Lengkap</label>
                                <div class="relative">
                                    <div class="absolute top-3.5 left-0 pl-3.5 flex items-start pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <textarea id="alamat" name="alamat" rows="3"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="Masukkan alamat lengkap Anda (RT/RW, Desa/Kelurahan, Kecamatan, Kota)">{{ old('alamat', $mahasiswa?->alamat) }}</textarea>
                                </div>
                                @error('alamat') <p class="text-xs text-red-600 mt-1.5 font-medium flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========== TAB: DATA AKADEMIK ========== --}}
            <div x-show="activeTab === 'akademik'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-9 h-9 bg-blue-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422a12.083 12.083 0 01.665 6.479A11.952 11.952 0 0012 20.055a11.952 11.952 0 00-6.824-2.998 12.078 12.078 0 01.665-6.479L12 14z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-800">Data Akademik</h2>
                            <p class="text-xs text-gray-400 mt-0.5">NIM, program studi, dan tahun angkatan</p>
                        </div>
                    </div>

                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

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
                                @error('nim') <p class="text-xs text-red-600 mt-1.5 font-medium flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>{{ $message }}</p> @enderror
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
                                        placeholder="2021">
                                </div>
                                @error('angkatan') <p class="text-xs text-red-600 mt-1.5 font-medium flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>{{ $message }}</p> @enderror
                            </div>

                            {{-- Program Studi --}}
                            <div>
                                <label for="prodi" class="block text-sm font-bold text-gray-700 mb-2">
                                    Program Studi <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/></svg>
                                    </div>
                                    <input id="prodi" name="prodi" type="text"
                                        value="{{ old('prodi', $mahasiswa?->prodi) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="Contoh: Teknik Informatika">
                                </div>
                                @error('prodi') <p class="text-xs text-red-600 mt-1.5 font-medium flex items-center gap-1"><svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01"/></svg>{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Informasi dosen --}}
                        @if($mahasiswa?->dosen)
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-100 rounded-xl flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-100 rounded-xl flex items-center justify-center flex-shrink-0">
                                <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-xs text-blue-500 font-bold uppercase tracking-wide">Dosen Pembimbing Akademik</p>
                                <p class="text-sm font-bold text-blue-800 mt-0.5">{{ $mahasiswa->dosen->name }}</p>
                                <p class="text-xs text-blue-500">{{ $mahasiswa->dosen->email }}</p>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ========== TAB: DATA KELUARGA ========== --}}
            <div x-show="activeTab === 'keluarga'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-9 h-9 bg-violet-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-800">Data Keluarga</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Nama orang tua dan informasi pekerjaan</p>
                        </div>
                    </div>

                    <div class="p-8 space-y-8">

                        {{-- Data Ayah --}}
                        <div>
                            <h3 class="text-sm font-extrabold text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="w-6 h-0.5 bg-violet-300 rounded"></span>
                                Data Ayah
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_ayah" class="block text-sm font-bold text-gray-700 mb-2">Nama Ayah</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <input id="nama_ayah" name="nama_ayah" type="text"
                                            value="{{ old('nama_ayah', $mahasiswa?->nama_ayah) }}"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                            placeholder="Masukkan nama ayah">
                                    </div>
                                    @error('nama_ayah') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="pekerjaan_ayah" class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan Ayah</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </div>
                                        <input id="pekerjaan_ayah" name="pekerjaan_ayah" type="text"
                                            value="{{ old('pekerjaan_ayah', $mahasiswa?->pekerjaan_ayah) }}"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                            placeholder="Contoh: Petani, PNS, Wiraswasta">
                                    </div>
                                    @error('pekerjaan_ayah') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Data Ibu --}}
                        <div>
                            <h3 class="text-sm font-extrabold text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="w-6 h-0.5 bg-violet-300 rounded"></span>
                                Data Ibu
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_ibu" class="block text-sm font-bold text-gray-700 mb-2">Nama Ibu</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                        </div>
                                        <input id="nama_ibu" name="nama_ibu" type="text"
                                            value="{{ old('nama_ibu', $mahasiswa?->nama_ibu) }}"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                            placeholder="Masukkan nama ibu">
                                    </div>
                                    @error('nama_ibu') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                                </div>
                                <div>
                                    <label for="pekerjaan_ibu" class="block text-sm font-bold text-gray-700 mb-2">Pekerjaan Ibu</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                        </div>
                                        <input id="pekerjaan_ibu" name="pekerjaan_ibu" type="text"
                                            value="{{ old('pekerjaan_ibu', $mahasiswa?->pekerjaan_ibu) }}"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                            placeholder="Contoh: Ibu Rumah Tangga, PNS">
                                    </div>
                                    @error('pekerjaan_ibu') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                                </div>
                            </div>
                        </div>

                        {{-- Penghasilan --}}
                        <div>
                            <h3 class="text-sm font-extrabold text-gray-500 uppercase tracking-widest mb-4 flex items-center gap-2">
                                <span class="w-6 h-0.5 bg-violet-300 rounded"></span>
                                Penghasilan Orang Tua
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="penghasilan_ortu" class="block text-sm font-bold text-gray-700 mb-2">Total Penghasilan Per Bulan (Rp)</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                            <span class="text-gray-400 text-sm font-bold">Rp</span>
                                        </div>
                                        <input id="penghasilan_ortu" name="penghasilan_ortu" type="number"
                                            value="{{ old('penghasilan_ortu', $mahasiswa?->penghasilan_ortu) }}"
                                            min="0"
                                            class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                            placeholder="Contoh: 3000000"
                                            x-model="penghasilanRaw"
                                            @input="updateLabelPenghasilan()">
                                    </div>
                                    @error('penghasilan_ortu') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                                </div>
                                <div class="flex items-end pb-1">
                                    <div class="w-full p-4 rounded-xl border border-dashed border-gray-200 bg-gray-50 flex items-center gap-3">
                                        <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0"
                                             :class="labelPenghasilanColor">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                        </div>
                                        <div>
                                            <p class="text-[11px] text-gray-400 font-bold uppercase tracking-wide">Kategori Penghasilan</p>
                                            <p class="text-sm font-bold text-gray-700 mt-0.5" x-text="labelPenghasilan">
                                                {{ $mahasiswa?->label_penghasilan ?? 'Belum diisi' }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ========== TAB: KRITERIA BEASISWA ========== --}}
            <div x-show="activeTab === 'beasiswa'" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-cloak>
                <div class="bg-white border border-gray-100 rounded-2xl shadow-sm hover:shadow-md transition-shadow overflow-hidden">
                    <div class="px-8 py-5 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
                        <div class="w-9 h-9 bg-amber-100 rounded-xl flex items-center justify-center">
                            <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-base font-bold text-gray-800">Kriteria Beasiswa (SAW)</h2>
                            <p class="text-xs text-gray-400 mt-0.5">Data yang digunakan untuk perhitungan skor seleksi</p>
                        </div>
                    </div>

                    <div class="p-8">
                        {{-- Info banner --}}
                        <div class="mb-6 p-4 bg-amber-50 border border-amber-100 rounded-xl flex items-start gap-3">
                            <svg class="w-5 h-5 text-amber-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            <p class="text-xs text-amber-700 font-medium leading-relaxed">Data ini digunakan dalam perhitungan SAW (Simple Additive Weighting) untuk seleksi penerima beasiswa. Pastikan data yang Anda masukkan sesuai dengan kondisi aktual dan dokumen yang dilampirkan.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                            {{-- IPK --}}
                            <div>
                                <label for="ipk" class="block text-sm font-bold text-gray-700 mb-2">
                                    IPK (Indeks Prestasi Kumulatif)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                                    </div>
                                    <input id="ipk" name="ipk" type="number" step="0.01" min="0" max="4"
                                        value="{{ old('ipk', $mahasiswa?->ipk) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="0.00 – 4.00"
                                        x-model="ipkValue"
                                        @input="updateIpkBar()">
                                </div>
                                {{-- IPK Progress bar --}}
                                <div class="mt-3">
                                    <div class="flex justify-between text-[10px] text-gray-400 mb-1">
                                        <span>0.00</span>
                                        <span x-text="ipkValue ? parseFloat(ipkValue).toFixed(2) : '—'" class="font-bold text-emerald-600"></span>
                                        <span>4.00</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-emerald-400 to-emerald-600 h-2 rounded-full transition-all duration-500"
                                             :style="'width: ' + (ipkValue ? Math.min(parseFloat(ipkValue)/4*100, 100) : 0) + '%'"></div>
                                    </div>
                                </div>
                                @error('ipk') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                            </div>

                            {{-- Prestasi --}}
                            <div>
                                <label for="prestasi" class="block text-sm font-bold text-gray-700 mb-2">
                                    Skor Prestasi (0 – 100)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                    </div>
                                    <input id="prestasi" name="prestasi" type="number" step="0.01" min="0" max="100"
                                        value="{{ old('prestasi', $mahasiswa?->prestasi) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="0 – 100"
                                        x-model="prestasiValue"
                                        @input="updatePrestasiBar()">
                                </div>
                                {{-- Progress bar --}}
                                <div class="mt-3">
                                    <div class="flex justify-between text-[10px] text-gray-400 mb-1">
                                        <span>0</span>
                                        <span x-text="prestasiValue ? parseFloat(prestasiValue).toFixed(1) : '—'" class="font-bold text-blue-600"></span>
                                        <span>100</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-blue-400 to-blue-600 h-2 rounded-full transition-all duration-500"
                                             :style="'width: ' + (prestasiValue ? Math.min(parseFloat(prestasiValue), 100) : 0) + '%'"></div>
                                    </div>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-2">Skor prestasi akademik/non-akademik sesuai standar fakultas.</p>
                                @error('prestasi') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                            </div>

                            {{-- Keaktifan Organisasi --}}
                            <div>
                                <label for="keaktifan_org" class="block text-sm font-bold text-gray-700 mb-2">
                                    Skor Keaktifan Organisasi (0 – 100)
                                </label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <input id="keaktifan_org" name="keaktifan_org" type="number" step="0.01" min="0" max="100"
                                        value="{{ old('keaktifan_org', $mahasiswa?->keaktifan_org) }}"
                                        class="w-full pl-10 pr-4 py-3 rounded-xl border border-gray-200 focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 bg-gray-50/50 transition-colors text-sm"
                                        placeholder="0 – 100"
                                        x-model="keaktifanValue"
                                        @input="updateKeaktifanBar()">
                                </div>
                                {{-- Progress bar --}}
                                <div class="mt-3">
                                    <div class="flex justify-between text-[10px] text-gray-400 mb-1">
                                        <span>0</span>
                                        <span x-text="keaktifanValue ? parseFloat(keaktifanValue).toFixed(1) : '—'" class="font-bold text-violet-600"></span>
                                        <span>100</span>
                                    </div>
                                    <div class="w-full bg-gray-100 rounded-full h-2">
                                        <div class="bg-gradient-to-r from-violet-400 to-violet-600 h-2 rounded-full transition-all duration-500"
                                             :style="'width: ' + (keaktifanValue ? Math.min(parseFloat(keaktifanValue), 100) : 0) + '%'"></div>
                                    </div>
                                </div>
                                <p class="text-[11px] text-gray-400 mt-2">Skor keaktifan dalam organisasi/kegiatan kampus.</p>
                                @error('keaktifan_org') <p class="text-xs text-red-600 mt-1.5 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Rangkuman skor visual --}}
                        <div class="mt-8 p-6 bg-gradient-to-br from-gray-50 to-white border border-gray-100 rounded-xl">
                            <h3 class="text-sm font-bold text-gray-600 mb-5 flex items-center gap-2">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                                Ringkasan Kriteria Saat Ini
                            </h3>
                            <div class="grid grid-cols-3 gap-4 text-center">
                                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">IPK</p>
                                    <p class="text-2xl font-extrabold text-emerald-600" x-text="ipkValue ? parseFloat(ipkValue).toFixed(2) : '{{ $mahasiswa?->ipk ? number_format($mahasiswa->ipk, 2) : '—' }}'"></p>
                                </div>
                                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Prestasi</p>
                                    <p class="text-2xl font-extrabold text-blue-600" x-text="prestasiValue ? parseFloat(prestasiValue).toFixed(1) : '{{ $mahasiswa?->prestasi ?? '—' }}'"></p>
                                </div>
                                <div class="bg-white rounded-xl p-4 border border-gray-100 shadow-sm">
                                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-wider mb-2">Keaktifan</p>
                                    <p class="text-2xl font-extrabold text-violet-600" x-text="keaktifanValue ? parseFloat(keaktifanValue).toFixed(1) : '{{ $mahasiswa?->keaktifan_org ?? '—' }}'"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- ===================== TOMBOL SIMPAN ===================== --}}
            <div class="mt-6 flex flex-col sm:flex-row items-center justify-between gap-4 bg-white border border-gray-100 rounded-2xl p-5 shadow-sm animate-slide-up">
                <div class="flex items-center gap-2 text-sm text-gray-500">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                    Data profil Anda tersimpan dengan aman.
                </div>
                <div class="flex items-center gap-3 w-full sm:w-auto">
                    <a href="{{ route('mahasiswa.dashboard') }}"
                        class="flex-1 sm:flex-initial px-6 py-3 rounded-xl border border-gray-200 text-sm font-bold text-gray-600 hover:bg-gray-50 hover:border-gray-300 transition-all text-center">
                        Batalkan
                    </a>
                    <button type="submit" id="btn-simpan-profil"
                        class="flex-1 sm:flex-initial flex items-center justify-center gap-2 px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-xl font-bold shadow-sm hover:shadow-md transition-all transform hover:-translate-y-0.5">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script>
        function profilMahasiswa() {
            return {
                activeTab: 'akun',
                ipkValue: '{{ old('ipk', $mahasiswa?->ipk ?? '') }}',
                prestasiValue: '{{ old('prestasi', $mahasiswa?->prestasi ?? '') }}',
                keaktifanValue: '{{ old('keaktifan_org', $mahasiswa?->keaktifan_org ?? '') }}',
                penghasilanRaw: '{{ old('penghasilan_ortu', $mahasiswa?->penghasilan_ortu ?? '') }}',
                labelPenghasilan: '{{ $mahasiswa?->label_penghasilan ?? 'Belum diisi' }}',
                labelPenghasilanColor: 'bg-gray-100 text-gray-500',

                updateIpkBar() { /* handled by Alpine binding */ },
                updatePrestasiBar() { /* handled by Alpine binding */ },
                updateKeaktifanBar() { /* handled by Alpine binding */ },

                updateLabelPenghasilan() {
                    const p = parseInt(this.penghasilanRaw) || 0;
                    if (p === 0) {
                        this.labelPenghasilan = 'Belum diisi';
                        this.labelPenghasilanColor = 'bg-gray-100 text-gray-500';
                    } else if (p < 1000000) {
                        this.labelPenghasilan = 'Di bawah Rp 1 juta';
                        this.labelPenghasilanColor = 'bg-red-100 text-red-600';
                    } else if (p < 2500000) {
                        this.labelPenghasilan = 'Rp 1 – 2,5 juta';
                        this.labelPenghasilanColor = 'bg-amber-100 text-amber-600';
                    } else if (p < 5000000) {
                        this.labelPenghasilan = 'Rp 2,5 – 5 juta';
                        this.labelPenghasilanColor = 'bg-blue-100 text-blue-600';
                    } else {
                        this.labelPenghasilan = 'Di atas Rp 5 juta';
                        this.labelPenghasilanColor = 'bg-emerald-100 text-emerald-600';
                    }
                },

                init() {
                    this.updateLabelPenghasilan();
                    // Jika ada error, buka tab yang mengandung error
                    @if($errors->has('name') || $errors->has('no_hp') || $errors->has('alamat'))
                        this.activeTab = 'akun';
                    @elseif($errors->has('nim') || $errors->has('prodi') || $errors->has('angkatan'))
                        this.activeTab = 'akademik';
                    @elseif($errors->has('nama_ayah') || $errors->has('nama_ibu') || $errors->has('pekerjaan_ayah') || $errors->has('pekerjaan_ibu') || $errors->has('penghasilan_ortu'))
                        this.activeTab = 'keluarga';
                    @elseif($errors->has('ipk') || $errors->has('prestasi') || $errors->has('keaktifan_org'))
                        this.activeTab = 'beasiswa';
                    @endif
                }
            }
        }
    </script>
</x-app-layout>
