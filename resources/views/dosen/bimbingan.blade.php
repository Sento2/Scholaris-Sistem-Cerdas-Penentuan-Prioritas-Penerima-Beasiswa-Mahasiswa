<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Mahasiswa Bimbingan
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Total Mahasiswa</p>
                <h3 class="text-3xl font-bold text-brand-navy mt-2">{{ $stats['total'] }}</h3>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Menunggu</p>
                <h3 class="text-3xl font-bold text-yellow-600 mt-2">{{ $stats['menunggu'] }}</h3>
            </div>
            <div class="bg-white rounded-xl shadow p-6">
                <p class="text-sm text-gray-500">Sudah Diverifikasi</p>
                <h3 class="text-3xl font-bold text-green-600 mt-2">{{ $stats['sudah_verif'] }}</h3>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            @if($mahasiswaList->isEmpty())
                <p class="text-gray-600">Belum ada mahasiswa bimbingan yang terdaftar.</p>
            @else
                <table class="min-w-full">
                    <thead class="border-b">
                        <tr class="text-left text-sm text-gray-600">
                            <th class="pb-3">Nama</th>
                            <th class="pb-3">NIM</th>
                            <th class="pb-3">Program Studi</th>
                            <th class="pb-3">Status</th>
                            <th class="pb-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($mahasiswaList as $mahasiswa)
                            <tr class="border-b hover:bg-gray-50">
                                <td class="py-4">{{ $mahasiswa->user?->name ?? 'Tidak Diketahui' }}</td>
                                <td>{{ $mahasiswa->nim }}</td>
                                <td>{{ $mahasiswa->prodi }}</td>
                                <td>
                                    @if($mahasiswa->pengajuanAktif)
                                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">
                                            {{ $mahasiswa->pengajuanAktif->label_status }}
                                        </span>
                                    @else
                                        <span class="px-3 py-1 rounded-full bg-gray-100 text-gray-700 text-sm">Belum Mengajukan</span>
                                    @endif
                                </td>
                                <td>
                                    @if($mahasiswa->pengajuanAktif)
                                        <a href="{{ route('dosen.verifikasi', $mahasiswa->pengajuanAktif->id) }}" class="text-[#1D9E75] hover:underline">Periksa</a>
                                    @else
                                        -
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>
    </div>
</x-app-layout>