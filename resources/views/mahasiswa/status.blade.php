<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Status Pengajuan Beasiswa
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white rounded-xl shadow p-6 max-w-2xl">
            @php
                $status = $pengajuan?->status;
                $submitted = (bool) $pengajuan;
                $verified = in_array($status, [\App\Models\Pengajuan::STATUS_DIVERIFIKASI, \App\Models\Pengajuan::STATUS_DIHITUNG, \App\Models\Pengajuan::STATUS_DITERIMA, \App\Models\Pengajuan::STATUS_DITOLAK]);
                $selection = in_array($status, [\App\Models\Pengajuan::STATUS_DIVERIFIKASI, \App\Models\Pengajuan::STATUS_DIHITUNG, \App\Models\Pengajuan::STATUS_DITERIMA, \App\Models\Pengajuan::STATUS_DITOLAK]);
                $announcement = in_array($status, [\App\Models\Pengajuan::STATUS_DITERIMA, \App\Models\Pengajuan::STATUS_DITOLAK]);
            @endphp

            <div class="space-y-6">
                <div class="flex items-center gap-4">
                    <div class="w-4 h-4 rounded-full {{ $submitted ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    <p>Formulir Pendaftaran Dikirim</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-4 h-4 rounded-full {{ $verified ? 'bg-green-500' : 'bg-gray-300' }}"></div>
                    <p>Berkas Diverifikasi</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-4 h-4 rounded-full {{ $selection ? 'bg-yellow-400' : 'bg-gray-300' }}"></div>
                    <p>Sedang Proses Seleksi</p>
                </div>

                <div class="flex items-center gap-4">
                    <div class="w-4 h-4 rounded-full {{ $announcement ? 'bg-blue-500' : 'bg-gray-300' }}"></div>
                    <p>Menunggu Pengumuman</p>
                </div>
            </div>

            <div class="mt-6 border-t pt-4 text-gray-700">
                @if($pengajuan)
                    <p class="font-semibold">Status saat ini:</p>
                    <p>{{ $pengajuan->label_status }}</p>
                    @if($pengajuan->catatan_dosen)
                        <p class="mt-2 text-sm text-gray-600">Catatan dosen: {{ $pengajuan->catatan_dosen }}</p>
                    @endif
                @else
                    <p class="text-gray-600">Belum ada pengajuan beasiswa. Silakan isi formulir pendaftaran terlebih dahulu.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>