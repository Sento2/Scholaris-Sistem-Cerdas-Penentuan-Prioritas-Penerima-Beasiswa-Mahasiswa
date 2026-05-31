<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Dashboard Mahasiswa
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Status Pengajuan</p>
                <h3 class="text-xl font-bold mt-2 {{ $pengajuan ? ($pengajuan->status === 'menunggu' ? 'text-yellow-600' : 'text-[#1D9E75]') : 'text-gray-600' }}">
                    {{ $pengajuan?->label_status ?? 'Belum Mengajukan' }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Skor SAW</p>
                <h3 class="text-3xl font-bold text-brand-navy mt-2">
                    {{ $pengajuan && $pengajuan->skor_saw !== null ? number_format($pengajuan->skor_saw, 2) : '-' }}
                </h3>
            </div>

            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Ranking</p>
                <h3 class="text-3xl font-bold text-brand-navy mt-2">
                    {{ $pengajuan && $pengajuan->rank ? '#'.$pengajuan->rank : '-' }}
                </h3>
            </div>

        </div>

        <div class="mt-6 bg-white rounded-xl shadow p-6">
            <h3 class="text-lg font-semibold text-brand-navy">Ringkasan Pengajuan</h3>

            @if($pengajuan)
                <div class="mt-4 space-y-3 text-gray-700">
                    <div>
                        <span class="font-semibold">Nama:</span> {{ $user->name }}
                    </div>
                    <div>
                        <span class="font-semibold">NIM:</span> {{ $mahasiswa?->nim ?? '-' }}
                    </div>
                    <div>
                        <span class="font-semibold">Program Studi:</span> {{ $mahasiswa?->prodi ?? '-' }}
                    </div>
                    <div>
                        <span class="font-semibold">Terakhir diperbarui:</span> {{ optional($pengajuan->updated_at)->format('d M Y') }}
                    </div>
                </div>
            @else
                <p class="mt-4 text-gray-600">Anda belum membuat pengajuan beasiswa. Silakan lengkapi formulir pendaftaran.</p>
            @endif
        </div>
    </div>
</x-app-layout>