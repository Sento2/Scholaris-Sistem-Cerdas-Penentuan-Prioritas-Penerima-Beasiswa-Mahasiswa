<x-app-layout>
<div class="max-w-2xl mx-auto space-y-6">

    {{-- Page Header --}}
    <div class="animate-fade-in">
        <div class="flex items-center gap-3 mb-1">
            <a href="{{ route('mahasiswa.dashboard') }}"
               class="w-8 h-8 bg-white border border-gray-200 rounded-xl flex items-center justify-center text-gray-500 hover:text-gray-700 hover:border-gray-300 transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
            </a>
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800">Skor Seleksi SAW</h1>
                <p class="text-sm text-gray-500">Hasil perhitungan Simple Additive Weighting Anda</p>
            </div>
        </div>
    </div>

    {{-- Hero Score Card --}}
    <div class="relative bg-gradient-to-br from-emerald-600 via-emerald-700 to-teal-800 rounded-2xl p-8 shadow-lg overflow-hidden animate-fade-in text-center">
        <div class="absolute -top-8 -right-8 w-40 h-40 bg-white/5 rounded-full pointer-events-none"></div>
        <div class="absolute -bottom-6 -left-6 w-32 h-32 bg-white/5 rounded-full pointer-events-none"></div>

        <div class="relative">
            <p class="text-emerald-200 text-xs font-bold uppercase tracking-widest mb-3">Skor Akhir SAW</p>
            <div class="flex items-end justify-center gap-2 mb-2">
                <span class="text-7xl md:text-8xl font-extrabold text-white leading-none">
                    {{ number_format($pengajuan->skor_saw ?? 0, 2) }}
                </span>
                <span class="text-2xl text-emerald-300 font-bold mb-3">/ 1.00</span>
            </div>

            {{-- Score meter --}}
            <div class="w-full max-w-xs mx-auto bg-white/20 rounded-full h-3 mb-5 overflow-hidden">
                <div class="bg-white h-3 rounded-full transition-all duration-1000 ease-out shadow-sm"
                     style="width: {{ min(100, round(($pengajuan->skor_saw ?? 0) * 100, 0)) }}%"></div>
            </div>

            {{-- Rank & Tanggal --}}
            <div class="flex items-center justify-center gap-8">
                @if($pengajuan->rank)
                <div>
                    <p class="text-emerald-200 text-xs font-bold uppercase tracking-wider mb-0.5">Peringkat</p>
                    <p class="text-2xl font-extrabold text-white">#{{ $pengajuan->rank }}</p>
                </div>
                <div class="w-px h-10 bg-white/20"></div>
                @endif
                <div>
                    <p class="text-emerald-200 text-xs font-bold uppercase tracking-wider mb-0.5">Dari Peserta</p>
                    <p class="text-2xl font-extrabold text-white">{{ $totalPeserta }}</p>
                </div>
                <div class="w-px h-10 bg-white/20"></div>
                <div>
                    <p class="text-emerald-200 text-xs font-bold uppercase tracking-wider mb-0.5">Diperbarui</p>
                    <p class="text-sm font-bold text-white">{{ optional($pengajuan->updated_at)->format('d M Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Rincian per Kriteria --}}
    @if($pengajuan->penilaian->count() > 0)
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-slide-up delay-100">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-50 rounded-xl flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-800">Rincian Skor Per Kriteria</h3>
        </div>

        <div class="divide-y divide-gray-50">
            @foreach($pengajuan->penilaian as $p)
            <div class="px-6 py-4 flex items-center gap-4 hover:bg-gray-50/50 transition-colors">
                <div class="flex-1 min-w-0">
                    <div class="flex items-center justify-between mb-1.5">
                        <p class="text-sm font-bold text-gray-800">{{ $p->kriteria->nama ?? 'Kriteria' }}</p>
                        <span class="text-[10px] font-bold text-gray-400 bg-gray-100 px-2 py-0.5 rounded-md">
                            Bobot {{ number_format(($p->kriteria->bobot ?? 0) * 100, 0) }}%
                        </span>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex-1 bg-gray-100 rounded-full h-2">
                            <div class="bg-emerald-500 h-2 rounded-full transition-all duration-700"
                                 style="width: {{ min(100, ($p->nilai_normalisasi ?? 0) * 100) }}%"></div>
                        </div>
                        <span class="text-xs font-bold text-emerald-600 w-12 text-right">
                            {{ number_format($p->nilai_normalisasi ?? 0, 3) }}
                        </span>
                    </div>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-[10px] text-gray-400 font-medium">Nilai Awal</p>
                    <p class="text-sm font-bold text-gray-700">{{ $p->nilai_asli ?? '—' }}</p>
                </div>
                <div class="text-right flex-shrink-0">
                    <p class="text-[10px] text-gray-400 font-medium">Skor</p>
                    <p class="text-sm font-bold text-gray-800">{{ number_format($p->skor ?? 0, 4) }}</p>
                </div>
            </div>
            @endforeach
        </div>

        {{-- Total --}}
        <div class="px-6 py-4 bg-gradient-to-r from-emerald-50 to-teal-50 border-t border-emerald-100 flex items-center justify-between">
            <span class="text-sm font-bold text-gray-700">Total Skor SAW</span>
            <span class="text-xl font-extrabold text-emerald-700">{{ number_format($pengajuan->skor_saw ?? 0, 3) }}</span>
        </div>
    </div>

    @else
    {{-- Tabel statis jika belum ada penilaian detail --}}
    <div class="bg-white border border-gray-100 rounded-2xl shadow-sm overflow-hidden animate-slide-up delay-100">
        <div class="px-6 py-4 border-b border-gray-100 bg-gray-50/50 flex items-center gap-3">
            <div class="w-8 h-8 bg-emerald-50 rounded-xl flex items-center justify-center">
                <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
            </div>
            <h3 class="text-sm font-bold text-gray-800">Data Kriteria Anda</h3>
        </div>

        @php
            $mhs = $mahasiswa ?? null;
            $kritItems = [
                ['label' => 'IPK',                  'nilai' => $mhs?->ipk ? number_format($mhs->ipk, 2) : '—',            'pct' => $mhs?->ipk ? min(100, ($mhs->ipk/4)*100) : 0],
                ['label' => 'Penghasilan Orang Tua', 'nilai' => $mhs?->penghasilan_ortu ? 'Rp '.number_format($mhs->penghasilan_ortu,0,',','.') : '—', 'pct' => 0],
                ['label' => 'Prestasi',              'nilai' => $mhs?->prestasi !== null ? $mhs->prestasi : '—',           'pct' => $mhs?->prestasi ?? 0],
                ['label' => 'Keaktifan Organisasi',  'nilai' => $mhs?->keaktifan_org !== null ? $mhs->keaktifan_org : '—','pct' => $mhs?->keaktifan_org ?? 0],
            ];
        @endphp

        <div class="divide-y divide-gray-50">
            @foreach($kritItems as $k)
            <div class="px-6 py-4 flex items-center gap-4">
                <div class="flex-1">
                    <div class="flex items-center justify-between mb-1.5">
                        <p class="text-sm font-bold text-gray-700">{{ $k['label'] }}</p>
                        <span class="text-sm font-bold text-gray-600">{{ $k['nilai'] }}</span>
                    </div>
                    <div class="w-full bg-gray-100 rounded-full h-2">
                        <div class="bg-emerald-400 h-2 rounded-full" style="width: {{ min(100, max(0, $k['pct'])) }}%"></div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
            <p class="text-xs text-gray-400 text-center">Detail skor per kriteria akan muncul setelah perhitungan SAW dilakukan oleh admin.</p>
        </div>
    </div>
    @endif

    {{-- Info Box --}}
    <div class="bg-blue-50 border border-blue-100 rounded-xl p-4 flex items-start gap-3 animate-slide-up delay-200">
        <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        <div>
            <p class="text-sm font-bold text-blue-800 mb-0.5">Cara membaca skor SAW</p>
            <p class="text-xs text-blue-700 leading-relaxed">
                Skor SAW berkisar antara 0 hingga 1. Semakin tinggi skor, semakin baik peluang Anda untuk diterima.
                Skor dihitung dari kombinasi bobot IPK, penghasilan orang tua, prestasi, dan keaktifan organisasi.
            </p>
        </div>
    </div>

</div>
</x-app-layout>