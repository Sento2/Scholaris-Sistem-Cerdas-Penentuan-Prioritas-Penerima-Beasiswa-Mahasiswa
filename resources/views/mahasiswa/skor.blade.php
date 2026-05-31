<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Skor SAW Mahasiswa
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white rounded-xl shadow p-6">

            <p class="text-gray-600 mb-2">Skor Akhir Seleksi</p>

            <div class="w-full bg-gray-200 rounded-full h-3 mb-4">
                <div class="bg-[#1D9E75] h-3 rounded-full" style="width: {{ min(100, round(($pengajuan->skor_saw ?? 0) * 100, 0)) }}%"></div>
            </div>

            <h3 class="text-4xl font-bold text-brand-navy">
                {{ number_format($pengajuan->skor_saw, 2) }}
            </h3>

            <p class="mt-4 text-gray-600">Ranking {{ $pengajuan->rank ? '#'.$pengajuan->rank : '-' }} dari {{ $totalPeserta }}</p>
            <p class="mt-2 text-sm text-gray-500">Pengajuan terakhir: {{ optional($pengajuan->created_at)->format('d M Y') }}</p>
        </div>
    </div>
</x-app-layout>