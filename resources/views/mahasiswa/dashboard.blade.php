<x-app-layout>
<div class="space-y-6">

    {{-- ============================================================
         HERO WELCOME BANNER
    ============================================================ --}}
    <div class="relative bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 rounded-2xl p-7 md:p-8 overflow-hidden shadow-lg animate-fade-in">
        {{-- Decorative blobs --}}
        <div class="absolute -top-12 -right-12 w-56 h-56 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-10 -left-10 w-40 h-40 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute top-1/2 left-1/3 w-24 h-24 bg-emerald-500/20 rounded-full pointer-events-none"></div>

        <div class="relative flex flex-col md:flex-row items-center md:items-start gap-5">
            {{-- Avatar --}}
            <div class="relative flex-shrink-0">
                <div class="w-20 h-20 rounded-2xl overflow-hidden border-2 border-white/30 shadow-xl">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&color=ffffff&background=059669&size=160&bold=true"
                         alt="Avatar" class="w-full h-full object-cover">
                </div>
                <span class="absolute -bottom-1 -right-1 w-5 h-5 bg-emerald-400 border-2 border-white rounded-full"></span>
            </div>

            {{-- Greeting --}}
            <div class="text-center md:text-left flex-1">
                <p class="text-emerald-200 text-sm font-semibold tracking-wide mb-1">
                    {{ now()->format('l, d F Y') }}
                </p>
                <h1 class="text-2xl md:text-3xl font-extrabold text-white leading-tight">
                    Selamat datang, {{ explode(' ', $user->name)[0] }}! 👋
                </h1>
                <p class="text-emerald-200/80 text-sm mt-1.5">
                    {{ $mahasiswa?->nim ? 'NIM: '.$mahasiswa->nim.' · ' : '' }}{{ $mahasiswa?->prodi ?? 'Lengkapi profil Anda' }}
                    {{ $mahasiswa?->angkatan ? ' · Angkatan '.$mahasiswa->angkatan : '' }}
                </p>

                {{-- Quick actions --}}
                <div class="flex flex-wrap justify-center md:justify-start gap-2.5 mt-4">
                    @if(!$pengajuan)
                        <a href="{{ route('mahasiswa.daftar') }}"
                           class="inline-flex items-center gap-1.5 bg-white text-emerald-700 text-xs font-bold px-4 py-2 rounded-lg shadow hover:bg-emerald-50 transition-colors">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                            Daftar Beasiswa
                        </a>
                    @endif
                    <a href="{{ route('mahasiswa.profil.edit') }}"
                       class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-bold px-4 py-2 rounded-lg border border-white/20 hover:bg-white/25 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        Edit Profil
                    </a>
                    <a href="{{ route('mahasiswa.status') }}"
                       class="inline-flex items-center gap-1.5 bg-white/15 text-white text-xs font-bold px-4 py-2 rounded-lg border border-white/20 hover:bg-white/25 transition-colors">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Lihat Status
                    </a>
                </div>
            </div>

            {{-- Status badge pojok kanan --}}
            @if($pengajuan)
            <div class="flex-shrink-0 text-center">
                @if($pengajuan->status === 'menunggu')
                    <div class="bg-amber-400/20 border border-amber-300/30 text-amber-100 rounded-xl px-5 py-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-2 h-2 bg-amber-300 rounded-full animate-pulse"></div>
                            <span class="text-xs font-bold uppercase tracking-wider">Menunggu</span>
                        </div>
                        <p class="text-xs text-amber-200">Verifikasi Dosen</p>
                    </div>
                @elseif($pengajuan->status === 'diverifikasi')
                    <div class="bg-blue-400/20 border border-blue-300/30 text-blue-100 rounded-xl px-5 py-3">
                        <div class="flex items-center gap-2 mb-1">
                            <div class="w-2 h-2 bg-blue-300 rounded-full animate-pulse"></div>
                            <span class="text-xs font-bold uppercase tracking-wider">Diverifikasi</span>
                        </div>
                        <p class="text-xs text-blue-200">Proses Seleksi</p>
                    </div>
                @elseif($pengajuan->status === 'diterima')
                    <div class="bg-emerald-400/20 border border-emerald-300/30 text-emerald-100 rounded-xl px-5 py-3">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            <span class="text-xs font-bold uppercase tracking-wider">Diterima!</span>
                        </div>
                        <p class="text-xs text-emerald-200">Selamat 🎉</p>
                    </div>
                @elseif($pengajuan->status === 'ditolak')
                    <div class="bg-red-400/20 border border-red-300/30 text-red-100 rounded-xl px-5 py-3">
                        <div class="flex items-center gap-2 mb-1">
                            <svg class="w-4 h-4 text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                            <span class="text-xs font-bold uppercase tracking-wider">Tidak Lolos</span>
                        </div>
                        <p class="text-xs text-red-200">Periode ini</p>
                    </div>
                @endif
            </div>
            @endif
        </div>
    </div>

    {{-- ============================================================
         4 STAT CARDS
    ============================================================ --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

        {{-- IPK --}}
        <div class="group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all animate-slide-up delay-100">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-emerald-50 rounded-xl flex items-center justify-center group-hover:bg-emerald-100 transition-colors">
                    <svg class="w-4.5 h-4.5 text-emerald-600" style="width:18px;height:18px" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">IPK</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-800">
                {{ $mahasiswa?->ipk ? number_format($mahasiswa->ipk, 2) : '—' }}
            </p>
            <div class="mt-2 w-full bg-gray-100 rounded-full h-1.5">
                <div class="bg-emerald-500 h-1.5 rounded-full transition-all duration-700"
                     style="width: {{ $mahasiswa?->ipk ? min(100, ($mahasiswa->ipk / 4) * 100) : 0 }}%"></div>
            </div>
            <p class="text-[11px] text-gray-400 mt-1.5">dari 4.00</p>
        </div>

        {{-- Skor SAW --}}
        <div class="group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all animate-slide-up delay-200">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-blue-50 rounded-xl flex items-center justify-center group-hover:bg-blue-100 transition-colors">
                    <svg style="width:18px;height:18px" class="text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Skor SAW</span>
            </div>
            <p class="text-3xl font-extrabold text-blue-600">
                {{ $pengajuan && $pengajuan->skor_saw !== null ? number_format($pengajuan->skor_saw, 3) : '—' }}
            </p>
            <div class="mt-2 w-full bg-gray-100 rounded-full h-1.5">
                <div class="bg-blue-500 h-1.5 rounded-full transition-all duration-700"
                     style="width: {{ $pengajuan?->skor_saw !== null ? min(100, $pengajuan->skor_saw * 100) : 0 }}%"></div>
            </div>
            <p class="text-[11px] text-gray-400 mt-1.5">dari 1.000</p>
        </div>

        {{-- Ranking --}}
        <div class="group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all animate-slide-up delay-300">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-amber-50 rounded-xl flex items-center justify-center group-hover:bg-amber-100 transition-colors">
                    <svg style="width:18px;height:18px" class="text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Ranking</span>
            </div>
            <p class="text-3xl font-extrabold text-gray-800">
                {{ $pengajuan?->rank ? '#'.$pengajuan->rank : '—' }}
            </p>
            <p class="text-[11px] text-gray-400 mt-3">dari semua pendaftar</p>
        </div>

        {{-- Status Pengajuan --}}
        <div class="group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-md hover:-translate-y-0.5 transition-all animate-slide-up delay-400">
            <div class="flex items-center justify-between mb-3">
                <div class="w-9 h-9 bg-violet-50 rounded-xl flex items-center justify-center group-hover:bg-violet-100 transition-colors">
                    <svg style="width:18px;height:18px" class="text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <span class="text-[10px] font-bold text-gray-400 uppercase tracking-widest">Status</span>
            </div>
            @if($pengajuan)
                @php
                    $statusConfig = [
                        'menunggu'    => ['bg-amber-100 text-amber-800',  'Menunggu'],
                        'diverifikasi'=> ['bg-blue-100 text-blue-800',    'Diverifikasi'],
                        'dihitung'    => ['bg-violet-100 text-violet-800','Dihitung'],
                        'diterima'    => ['bg-emerald-100 text-emerald-800','Diterima'],
                        'ditolak'     => ['bg-red-100 text-red-800',      'Ditolak'],
                    ];
                    $cfg = $statusConfig[$pengajuan->status] ?? ['bg-gray-100 text-gray-600', $pengajuan->status];
                @endphp
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold {{ $cfg[0] }}">
                    {{ $cfg[1] }}
                </span>
            @else
                <span class="inline-flex items-center px-2.5 py-1 rounded-lg text-xs font-bold bg-gray-100 text-gray-500">Belum Ada</span>
            @endif
            <p class="text-[11px] text-gray-400 mt-2.5">
                @if($pengajuan)
                    {{ optional($pengajuan->updated_at)->format('d M Y') }}
                @else
                    Belum pernah mendaftar
                @endif
            </p>
        </div>
    </div>

    {{-- ============================================================
         NOTIFICATION ALERTS
    ============================================================ --}}
    @if(!$mahasiswa || !$mahasiswa->nim)
    <div class="bg-amber-50 border border-amber-200 rounded-xl p-4 flex items-start gap-3 animate-slide-up">
        <div class="w-8 h-8 bg-amber-100 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div class="flex-1">
            <p class="text-sm font-bold text-amber-800">Profil belum lengkap!</p>
            <p class="text-xs text-amber-700 mt-0.5">Lengkapi data profil Anda terlebih dahulu sebelum mendaftar beasiswa.</p>
        </div>
        <a href="{{ route('mahasiswa.profil.edit') }}"
           class="flex-shrink-0 text-xs font-bold text-amber-700 bg-amber-100 hover:bg-amber-200 px-3 py-1.5 rounded-lg transition-colors">
            Lengkapi
        </a>
    </div>
    @endif

    @if($pengajuan && $pengajuan->status === 'menunggu')
    <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3 animate-slide-up">
        <div class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-blue-800">Pengajuan sedang diproses</p>
            <p class="text-xs text-blue-700 mt-0.5">Berkas Anda sedang diverifikasi oleh Dosen Pembimbing Akademik. Proses ini biasanya 2–3 hari kerja.</p>
        </div>
    </div>
    @endif

    @if($pengajuan && $pengajuan->status === 'diterima' && $pengajuan->catatan_admin)
    <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-4 flex items-start gap-3 animate-slide-up">
        <div class="w-8 h-8 bg-emerald-100 rounded-full flex items-center justify-center flex-shrink-0">
            <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        </div>
        <div>
            <p class="text-sm font-bold text-emerald-800">🎉 Selamat! Anda diterima sebagai penerima beasiswa!</p>
            @if($pengajuan->catatan_admin)
            <p class="text-xs text-emerald-700 mt-0.5">{{ $pengajuan->catatan_admin }}</p>
            @endif
        </div>
    </div>
    @endif

    {{-- ============================================================
         PROGRESS STEPPER & KONTEN PENGAJUAN
    ============================================================ --}}
    @if($pengajuan)
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Progress Stepper --}}
        <div class="lg:col-span-3 bg-white border border-gray-100 rounded-2xl p-6 md:p-8 shadow-sm animate-slide-up delay-200">
            <div class="flex items-center justify-between mb-8">
                <h3 class="text-base font-bold text-gray-800">Progress Pengajuan</h3>
                <a href="{{ route('mahasiswa.status') }}"
                   class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 transition-colors">
                    Detail
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>

            @php
                $steps = [
                    ['label' => 'Diajukan',    'done' => true],
                    ['label' => 'Verifikasi',  'done' => in_array($pengajuan->status, ['diverifikasi','dihitung','diterima','ditolak'])],
                    ['label' => 'Seleksi SAW', 'done' => in_array($pengajuan->status, ['dihitung','diterima','ditolak'])],
                    ['label' => 'Pengumuman',  'done' => in_array($pengajuan->status, ['diterima','ditolak'])],
                ];
                $currentStep = collect($steps)->filter(fn($s)=>$s['done'])->count();
            @endphp

            <div class="relative flex items-start justify-between">
                {{-- Progress line background --}}
                <div class="absolute top-4 left-0 right-0 h-0.5 bg-gray-100" style="left:4%;right:4%"></div>
                {{-- Progress line filled --}}
                <div class="absolute top-4 h-0.5 bg-emerald-500 transition-all duration-1000"
                     style="left:4%; width: {{ max(0, ($currentStep - 1) / (count($steps) - 1) * 92) }}%"></div>

                @foreach($steps as $i => $step)
                @php $isActive = !$step['done'] && ($i === 0 || $steps[$i-1]['done']); @endphp
                <div class="relative flex flex-col items-center gap-2 z-10" style="width:{{ 100/count($steps) }}%">
                    <div class="w-8 h-8 rounded-full flex items-center justify-center border-2 transition-all duration-500
                        {{ $step['done']
                            ? 'bg-emerald-500 border-emerald-500 text-white shadow-md shadow-emerald-200'
                            : ($isActive
                                ? 'bg-white border-emerald-500 text-emerald-500'
                                : 'bg-white border-gray-200 text-gray-300') }}">
                        @if($step['done'])
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @elseif($isActive)
                            <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full animate-pulse"></div>
                        @else
                            <div class="w-2 h-2 bg-gray-200 rounded-full"></div>
                        @endif
                    </div>
                    <span class="text-[11px] font-bold text-center leading-tight
                        {{ $step['done'] ? 'text-emerald-700' : ($isActive ? 'text-emerald-600' : 'text-gray-400') }}">
                        {{ $step['label'] }}
                    </span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Rincian Skor SAW --}}
        <div class="lg:col-span-2 bg-white border border-gray-100 rounded-2xl shadow-sm animate-slide-up delay-300">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-8 h-8 bg-blue-50 rounded-xl flex items-center justify-center">
                        <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h3 class="text-sm font-bold text-gray-800">Rincian Kriteria</h3>
                </div>
                @if($pengajuan->skor_saw !== null)
                <a href="{{ route('mahasiswa.skor') }}"
                   class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1 bg-emerald-50 hover:bg-emerald-100 px-3 py-1.5 rounded-lg transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Lihat Skor
                </a>
                @endif
            </div>

            <div class="p-6">
                @if($mahasiswa)
                <div class="space-y-4">
                    @php
                        $kriteria = [
                            ['nama' => 'IPK', 'nilai' => $mahasiswa->ipk ? number_format($mahasiswa->ipk, 2) : '—', 'max' => '4.00', 'pct' => $mahasiswa->ipk ? min(100, ($mahasiswa->ipk/4)*100) : 0, 'color' => 'emerald'],
                            ['nama' => 'Penghasilan Ortu', 'nilai' => $mahasiswa->penghasilan_ortu ? 'Rp '.number_format($mahasiswa->penghasilan_ortu,0,',','.') : '—', 'max' => null, 'pct' => $mahasiswa->penghasilan_ortu ? min(100, (5000000/$mahasiswa->penghasilan_ortu)*30) : 0, 'color' => 'blue'],
                            ['nama' => 'Prestasi', 'nilai' => $mahasiswa->prestasi !== null ? $mahasiswa->prestasi : '—', 'max' => '100', 'pct' => $mahasiswa->prestasi ?? 0, 'color' => 'violet'],
                            ['nama' => 'Keaktifan Org.', 'nilai' => $mahasiswa->keaktifan_org !== null ? $mahasiswa->keaktifan_org : '—', 'max' => '100', 'pct' => $mahasiswa->keaktifan_org ?? 0, 'color' => 'amber'],
                        ];
                    @endphp
                    @foreach($kriteria as $k)
                    <div class="flex items-center gap-4">
                        <div class="w-32 flex-shrink-0">
                            <p class="text-xs font-bold text-gray-600">{{ $k['nama'] }}</p>
                            <p class="text-xs text-gray-400">{{ $k['nilai'] }}{{ $k['max'] ? ' / '.$k['max'] : '' }}</p>
                        </div>
                        <div class="flex-1 bg-gray-100 rounded-full h-2">
                            <div class="h-2 rounded-full bg-{{ $k['color'] }}-500 transition-all duration-700"
                                 style="width: {{ min(100, max(0, $k['pct'])) }}%"></div>
                        </div>
                        <span class="w-10 text-right text-xs font-bold text-gray-500">{{ round($k['pct']) }}%</span>
                    </div>
                    @endforeach
                </div>

                @if($pengajuan->skor_saw !== null)
                <div class="mt-5 flex items-center justify-between bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-100 rounded-xl px-5 py-3.5">
                    <span class="text-sm font-bold text-gray-700">Total Skor SAW</span>
                    <span class="text-xl font-extrabold text-emerald-700">{{ number_format($pengajuan->skor_saw, 3) }}</span>
                </div>
                @endif
                @else
                <div class="text-center py-6 text-gray-400">
                    <svg class="w-10 h-10 mx-auto mb-2 opacity-40" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    <p class="text-sm">Data belum tersedia</p>
                </div>
                @endif
            </div>
        </div>

        {{-- Status Dokumen --}}
        <div class="bg-white border border-gray-100 rounded-2xl shadow-sm animate-slide-up delay-400">
            <div class="px-6 py-5 border-b border-gray-100 flex items-center gap-3">
                <div class="w-8 h-8 bg-violet-50 rounded-xl flex items-center justify-center">
                    <svg class="w-4 h-4 text-violet-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                </div>
                <h3 class="text-sm font-bold text-gray-800">Dokumen Pengajuan</h3>
            </div>

            <div class="p-6 space-y-3">
                @php
                    $docs = [
                        ['key' => 'dokumen_ktp',       'label' => 'KTP'],
                        ['key' => 'dokumen_kk',        'label' => 'Kartu Keluarga'],
                        ['key' => 'dokumen_sktm',      'label' => 'SKTM / Slip Gaji'],
                        ['key' => 'dokumen_transkrip', 'label' => 'Transkrip Nilai'],
                        ['key' => 'dokumen_prestasi',  'label' => 'Sertifikat Prestasi', 'optional' => true],
                    ];
                @endphp
                @foreach($docs as $doc)
                @php $uploaded = !empty($pengajuan->{$doc['key']}); @endphp
                <div class="flex items-center gap-3 p-3 rounded-xl {{ $uploaded ? 'bg-emerald-50/50' : 'bg-gray-50' }} border {{ $uploaded ? 'border-emerald-100' : 'border-gray-100' }}">
                    <div class="w-8 h-8 rounded-lg flex items-center justify-center flex-shrink-0 {{ $uploaded ? 'bg-emerald-100 text-emerald-600' : 'bg-gray-100 text-gray-400' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-xs font-bold text-gray-700 truncate">{{ $doc['label'] }}</p>
                        @if(!empty($doc['optional']) && !$uploaded)
                        <p class="text-[10px] text-gray-400">Opsional</p>
                        @endif
                    </div>
                    <div class="flex-shrink-0">
                        @if($uploaded)
                            <div class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            </div>
                        @else
                            <div class="w-5 h-5 bg-gray-200 rounded-full flex items-center justify-center">
                                <svg class="w-3 h-3 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/></svg>
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach

                @if($pengajuan->catatan_dosen)
                <div class="mt-2 p-3 bg-amber-50 border border-amber-100 rounded-xl">
                    <p class="text-[10px] font-bold text-amber-600 uppercase tracking-wide mb-1">Catatan Dosen</p>
                    <p class="text-xs text-amber-800">{{ $pengajuan->catatan_dosen }}</p>
                </div>
                @endif
            </div>
        </div>
    </div>
    @else
    {{-- ============================================================
         EMPTY STATE - BELUM ADA PENGAJUAN
    ============================================================ --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-10 md:p-16 shadow-sm text-center animate-slide-up delay-200">
        <div class="w-20 h-20 bg-emerald-50 rounded-2xl flex items-center justify-center mx-auto mb-6">
            <svg class="w-10 h-10 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-xl font-bold text-gray-800 mb-2">Belum Ada Pengajuan Beasiswa</h3>
        <p class="text-gray-500 text-sm max-w-sm mx-auto mb-8">
            Anda belum pernah mengajukan beasiswa. Daftar sekarang dan lengkapi data untuk mengikuti seleksi.
        </p>

        <div class="flex flex-col sm:flex-row gap-3 justify-center">
            <a href="{{ route('mahasiswa.daftar') }}"
               class="inline-flex items-center justify-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-8 py-3.5 rounded-xl font-bold shadow-sm hover:shadow-md transition-all transform hover:-translate-y-0.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                Daftar Beasiswa Sekarang
            </a>
            <a href="{{ route('mahasiswa.profil.edit') }}"
               class="inline-flex items-center justify-center gap-2 border border-gray-200 hover:border-gray-300 text-gray-600 hover:text-gray-800 px-6 py-3.5 rounded-xl font-bold transition-all">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Lengkapi Profil
            </a>
        </div>

        {{-- Timeline preview --}}
        <div class="mt-12 grid grid-cols-1 sm:grid-cols-3 gap-4 text-left max-w-2xl mx-auto">
            @foreach([
                ['icon' => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z', 'step' => '01', 'title' => 'Isi Formulir', 'desc' => 'Lengkapi data diri dan unggah dokumen persyaratan'],
                ['icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z', 'step' => '02', 'title' => 'Verifikasi Dosen', 'desc' => 'Dosen pembimbing memeriksa kelengkapan berkas'],
                ['icon' => 'M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z', 'step' => '03', 'title' => 'Seleksi SAW', 'desc' => 'Sistem menghitung skor dan mengumumkan hasil']
            ] as $item)
            <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
                <div class="flex items-center gap-3 mb-2">
                    <div class="w-8 h-8 bg-emerald-100 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/></svg>
                    </div>
                    <span class="text-[10px] font-extrabold text-gray-400 tracking-widest">STEP {{ $item['step'] }}</span>
                </div>
                <p class="text-sm font-bold text-gray-800">{{ $item['title'] }}</p>
                <p class="text-xs text-gray-500 mt-1">{{ $item['desc'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
    @endif

</div>
</x-app-layout>