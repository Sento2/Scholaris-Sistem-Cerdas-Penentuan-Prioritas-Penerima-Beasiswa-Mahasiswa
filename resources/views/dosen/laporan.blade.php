<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Laporan Mahasiswa
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto mb-6">
            @if($mahasiswaList->isEmpty())
                <p class="text-gray-600">Belum ada data laporan mahasiswa untuk bimbingan Anda.</p>
            @else
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="pb-3">Nama</th>
                            <th class="pb-3">NIM</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Skor SAW</th>
                            <th class="pb-3">Ranking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswaList as $mahasiswa)
                            @php $pengajuan = $mahasiswa->pengajuan->first(); @endphp
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">{{ $mahasiswa->user?->name ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>
                                    @if($pengajuan)
                                        {{ $pengajuan->label_status }}
                                    @else
                                        Belum diproses
                                    @endif
                                </td>
                                <td>{{ $pengajuan?->skor_saw !== null ? number_format($pengajuan->skor_saw, 2) : '-' }}</td>
                                <td>{{ $pengajuan?->rank ? '#'.$pengajuan->rank : '-' }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>