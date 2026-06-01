<x-app-layout>
<div class="max-w-3xl mx-auto space-y-6">

    {{-- ============================================================
         PAGE HEADER
    ============================================================ --}}
    <div class="animate-fade-in">
        <div class="flex items-center gap-3 mb-1">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="w-8 h-8 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800">Status Pengajuan</h1>
                <p class="text-sm text-gray-500">Pantau perkembangan pengajuan beasiswa Anda</p>
            </div>
        </div>
    </div>

    @if(!$pengajuan)
    {{-- ============================================================
         EMPTY STATE
    ============================================================ --}}
    <div class="bg-white border border-gray-100 rounded-2xl p-12 shadow-sm text-center animate-slide-up">
        <div class="w-20 h-20 bg-gray-50 rounded-2xl flex items-center justify-center mx-auto mb-5">
            <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
            </svg>
        </div>
        <h3 class="text-lg font-bold text-gray-700 mb-2">Belum Ada Pengajuan</h3>
        <p class="text-sm text-gray-500 mb-6 max-w-xs mx-auto">Anda belum pernah mengajukan beasiswa. Silakan isi formulir pendaftaran terlebih dahulu.</p>
        <a href="{{ route('mahasiswa.daftar') }}"
           class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white px-7 py-3 rounded-xl font-bold shadow-sm hover:shadow-md transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
            Daftar Sekarang
        </a>
    </div>

    @else
    {{-- ============================================================
         STATUS BADGE UTAMA
    ============================================================ --}}
    @php
        $statusMap = [
            'menunggu'     => ['bg' => 'bg-amber-50',   'border' => 'border-amber-200',  'icon_bg' => 'bg-amber-100',  'icon_color' => 'text-amber-600',  'text' => 'text-amber-800',  'label' => 'Menunggu Verifikasi', 'desc' => 'Pengajuan Anda sedang menunggu untuk diperiksa oleh Dosen Pembimbing Akademik.'],
            'diverifikasi' => ['bg' => 'bg-blue-50',    'border' => 'border-blue-200',   'icon_bg' => 'bg-blue-100',   'icon_color' => 'text-blue-600',   'text' => 'text-blue-800',   'label' => 'Sedang Diverifikasi', 'desc' => 'Dosen pembimbing sedang memeriksa kelengkapan dan keabsahan berkas Anda.'],
            'dihitung'     => ['bg' => 'bg-violet-50',  'border' => 'border-violet-200', 'icon_bg' => 'bg-violet-100', 'icon_color' => 'text-violet-600', 'text' => 'text-violet-800', 'label' => 'Proses Seleksi SAW',  'desc' => 'Sistem sedang menghitung skor menggunakan metode Simple Additive Weighting.'],
            'diterima'     => ['bg' => 'bg-emerald-50', 'border' => 'border-emerald-200','icon_bg' => 'bg-emerald-100','icon_color' => 'text-emerald-600','text' => 'text-emerald-800','label' => 'Diterima 🎉',         'desc' => 'Selamat! Anda diterima sebagai penerima beasiswa pada periode ini.'],
            'ditolak'      => ['bg' => 'bg-red-50',     'border' => 'border-red-200',    'icon_bg' => 'bg-red-100',    'icon_color' => 'text-red-600',    'text' => 'text-red-800',    'label' => 'Tidak Lolos',         'desc' => 'Maaf, Anda tidak lolos seleksi pada periode ini. Semangat untuk periode berikutnya!'],
        ];
        $sc = $statusMap[$pengajuan->status] ?? $statusMap['menunggu'];

        $submitted    = true;
        $verified     = in_array($pengajuan->status, ['diverifikasi','dihitung','diterima','ditolak']);
        $selection    = in_array($pengajuan->status, ['dihitung','diterima','ditolak']);
        $announcement = in_array($pengajuan->status, ['diterima','ditolak']);
    @endphp

    <div class="{{ $sc['bg'] }} {{ $sc['border'] }} border rounded-2xl p-6 animate-slide-up shadow-sm">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 {{ $sc['icon_bg'] }} rounded-2xl flex items-center justify-center flex-shrink-0">
                @if($pengajuan->status === 'menunggu')
                    <svg class="w-6 h-6 {{ $sc['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @elseif($pengajuan->status === 'diverifikasi')
                    <svg class="w-6 h-6 {{ $sc['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                @elseif($pengajuan->status === 'dihitung')
                    <svg class="w-6 h-6 {{ $sc['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                @elseif($pengajuan->status === 'diterima')
                    <svg class="w-6 h-6 {{ $sc['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                @else
                    <svg class="w-6 h-6 {{ $sc['icon_color'] }}" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                @endif
            </div>
            <div class="flex-1">
                <p class="text-[11px] font-bold {{ $sc['icon_color'] }} uppercase tracking-widest mb-0.5">Status Pengajuan</p>
                <h2 class="text-lg font-extrabold {{ $sc['text'] }}">{{ $sc['label'] }}</h2>
                <p class="text-sm {{ $sc['text'] }} opacity-80 mt-1">{{ $sc['desc'] }}</p>
            </div>
            <div class="flex-shrink-0 text-right">
                <p class="text-[10px] text-gray-400 font-bold uppercase tracking-wide">Terakhir Update</p>
                <p class="text-sm font-bold text-gray-600 mt-0.5">{{ optional($pengajuan->updated_at)->format('d M Y') }}</p>
                <p class="text-xs text-gray-400">{{ optional($pengajuan->updated_at)->format('H:i') }}</p>
            </div>
        </div>
    </div>

    {{-- ============================================================
         TIMELINE STEPS
    ============================================================ --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-slide-up delay-100">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50">
            <h3 class="text-sm font-bold text-gray-700">Alur Proses Seleksi</h3>
        </div>

        <div class="p-6 space-y-0">
            @php
                $timelineSteps = [
                    [
                        'title'   => 'Formulir Pendaftaran Dikirim',
                        'desc'    => 'Data diri, kriteria, dan dokumen pendukung telah berhasil dikirimkan.',
                        'done'    => $submitted,
                        'active'  => false,
                        'time'    => $pengajuan->created_at?->format('d M Y · H:i'),
                        'icon'    => 'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z',
                    ],
                    [
                        'title'   => 'Verifikasi Dosen Pembimbing',
                        'desc'    => 'Dosen memeriksa keabsahan dan kelengkapan berkas yang Anda lampirkan.',
                        'done'    => $verified,
                        'active'  => $submitted && !$verified,
                        'time'    => $verified && $pengajuan->diverifikasi_at ? $pengajuan->diverifikasi_at->format('d M Y · H:i') : null,
                        'icon'    => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
                    ],
                    [
                        'title'   => 'Seleksi Algoritma SAW',
                        'desc'    => 'Sistem menghitung dan meranking seluruh peserta menggunakan metode SAW.',
                        'done'    => $selection,
                        'active'  => $verified && !$selection,
                        'time'    => $selection && $pengajuan->dihitung_at ? $pengajuan->dihitung_at->format('d M Y · H:i') : null,
                        'icon'    => 'M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z',
                    ],
                    [
                        'title'   => 'Pengumuman Hasil Akhir',
                        'desc'    => $pengajuan->status === 'diterima'
                                        ? 'Selamat! Anda diterima sebagai penerima beasiswa!'
                                        : ($pengajuan->status === 'ditolak'
                                            ? 'Maaf, Anda tidak lolos seleksi pada periode ini.'
                                            : 'Keputusan final penerimaan beasiswa dari jurusan.'),
                        'done'    => $announcement,
                        'active'  => $selection && !$announcement,
                        'rejected'=> $pengajuan->status === 'ditolak',
                        'time'    => $announcement && $pengajuan->diputuskan_at ? $pengajuan->diputuskan_at->format('d M Y · H:i') : null,
                        'icon'    => 'M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z',
                    ],
                ];
            @endphp

            @foreach($timelineSteps as $i => $step)
            <div class="flex gap-4 {{ $i < count($timelineSteps) - 1 ? 'pb-6' : '' }}">
                {{-- Icon + line --}}
                <div class="flex flex-col items-center flex-shrink-0">
                    <div class="w-9 h-9 rounded-full flex items-center justify-center border-2 transition-all duration-500 flex-shrink-0
                        {{ isset($step['rejected']) && $step['rejected'] && $step['done']
                            ? 'bg-red-500 border-red-500 text-white shadow-sm'
                            : ($step['done']
                                ? 'bg-emerald-500 border-emerald-500 text-white shadow-sm shadow-emerald-200'
                                : ($step['active']
                                    ? 'bg-white border-emerald-500 text-emerald-600'
                                    : 'bg-white border-gray-200 text-gray-300')) }}">
                        @if(isset($step['rejected']) && $step['rejected'] && $step['done'])
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"/></svg>
                        @elseif($step['done'])
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        @elseif($step['active'])
                            <div class="w-3 h-3 bg-emerald-500 rounded-full animate-pulse"></div>
                        @else
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="{{ $step['icon'] }}"/></svg>
                        @endif
                    </div>
                    @if($i < count($timelineSteps) - 1)
                    <div class="w-0.5 flex-1 mt-1.5 rounded-full {{ $step['done'] ? 'bg-emerald-300' : 'bg-gray-100' }}"></div>
                    @endif
                </div>

                {{-- Content --}}
                <div class="flex-1 {{ $i < count($timelineSteps) - 1 ? 'pb-1' : '' }}">
                    <div class="flex items-start justify-between gap-2">
                        <div>
                            <h4 class="text-sm font-bold
                                {{ isset($step['rejected']) && $step['rejected'] && $step['done']
                                    ? 'text-red-700'
                                    : ($step['done'] ? 'text-gray-800' : ($step['active'] ? 'text-emerald-700' : 'text-gray-400')) }}">
                                {{ $step['title'] }}
                                @if($step['active'])
                                    <span class="ml-2 inline-flex items-center gap-1 text-[10px] font-bold bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded-full">
                                        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></div>
                                        Berlangsung
                                    </span>
                                @endif
                            </h4>
                            <p class="text-xs text-gray-500 mt-0.5 leading-relaxed">{{ $step['desc'] }}</p>
                        </div>
                        @if($step['time'])
                        <span class="flex-shrink-0 text-[10px] font-medium text-gray-400 bg-gray-50 border border-gray-100 px-2 py-1 rounded-lg">{{ $step['time'] }}</span>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    {{-- ============================================================
         INFO CARDS (Catatan Dosen + Skor)
    ============================================================ --}}
    @if($pengajuan->catatan_dosen || $pengajuan->skor_saw !== null || $pengajuan->rank)
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 animate-slide-up delay-200">

        @if($pengajuan->catatan_dosen)
        <div class="bg-amber-50 border border-amber-100 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-7 h-7 bg-amber-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                </div>
                <h4 class="text-sm font-bold text-amber-800">Catatan Dosen Pembimbing</h4>
            </div>
            <p class="text-sm text-amber-700 leading-relaxed">{{ $pengajuan->catatan_dosen }}</p>
        </div>
        @endif

        @if($pengajuan->catatan_admin)
        <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-7 h-7 bg-blue-100 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/></svg>
                </div>
                <h4 class="text-sm font-bold text-blue-800">Catatan Admin Jurusan</h4>
            </div>
            <p class="text-sm text-blue-700 leading-relaxed">{{ $pengajuan->catatan_admin }}</p>
        </div>
        @endif

        @if($pengajuan->skor_saw !== null)
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center justify-between mb-3">
                <div class="flex items-center gap-2">
                    <div class="w-7 h-7 bg-emerald-50 rounded-lg flex items-center justify-center">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                    </div>
                    <h4 class="text-sm font-bold text-gray-700">Skor SAW</h4>
                </div>
                <a href="{{ route('mahasiswa.skor') }}"
                   class="text-xs font-bold text-emerald-600 hover:text-emerald-700 flex items-center gap-1">
                    Detail
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                </a>
            </div>
            <p class="text-3xl font-extrabold text-emerald-600">{{ number_format($pengajuan->skor_saw, 3) }}</p>
            <div class="w-full bg-gray-100 rounded-full h-2 mt-2">
                <div class="bg-emerald-500 h-2 rounded-full" style="width: {{ min(100, $pengajuan->skor_saw * 100) }}%"></div>
            </div>
        </div>
        @endif

        @if($pengajuan->rank)
        <div class="bg-white border border-gray-100 rounded-2xl p-5 shadow-sm">
            <div class="flex items-center gap-2 mb-3">
                <div class="w-7 h-7 bg-amber-50 rounded-lg flex items-center justify-center">
                    <svg class="w-4 h-4 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"/></svg>
                </div>
                <h4 class="text-sm font-bold text-gray-700">Posisi Ranking</h4>
            </div>
            <p class="text-3xl font-extrabold text-amber-600">#{{ $pengajuan->rank }}</p>
            <p class="text-xs text-gray-400 mt-1.5">dari semua pendaftar</p>
        </div>
        @endif
    </div>
    @endif
    @endif

</div>
</x-app-layout>