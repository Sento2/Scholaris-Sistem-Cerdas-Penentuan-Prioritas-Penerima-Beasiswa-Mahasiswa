<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Verifikasi Berkas Mahasiswa
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white rounded-xl shadow p-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <p class="text-sm text-gray-500">Nama Mahasiswa</p>
                    <p class="font-semibold text-brand-navy">{{ $pengajuan->mahasiswa->user?->name ?? 'Tidak Diketahui' }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Status Pengajuan</p>
                    <p class="font-semibold text-yellow-600">{{ $pengajuan->label_status }}</p>
                </div>
            </div>

            <div class="mb-6 grid gap-4 md:grid-cols-2">
                <div>
                    <p class="text-sm text-gray-500">NIM</p>
                    <p>{{ $pengajuan->mahasiswa->nim }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Program Studi</p>
                    <p>{{ $pengajuan->mahasiswa->prodi }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Alamat</p>
                    <p>{{ $pengajuan->mahasiswa->alamat }}</p>
                </div>
                <div>
                    <p class="text-sm text-gray-500">Catatan Dosen</p>
                    <p>{{ $pengajuan->catatan_dosen ?? '-' }}</p>
                </div>
            </div>

            <div class="mb-6">
                <h3 class="text-lg font-semibold text-brand-navy">Dokumen</h3>
                <div class="mt-3 grid gap-3">
                    @foreach(['dokumen_ktp' => 'KTP', 'dokumen_kk' => 'KK', 'dokumen_sktm' => 'SKTM', 'dokumen_transkrip' => 'Transkrip', 'dokumen_prestasi' => 'Prestasi'] as $field => $label)
                        @if($pengajuan->$field)
                            <a href="{{ Storage::url($pengajuan->$field) }}" target="_blank" class="inline-block rounded-lg border border-gray-200 px-4 py-2 text-sm text-[#1D9E75] hover:bg-gray-50">
                                {{ $label }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <form method="POST" action="{{ route('dosen.verifikasi.proses', $pengajuan->id) }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <p class="font-medium">Keputusan</p>
                        <div class="mt-3 space-y-2">
                            <label class="flex items-center gap-2">
                                <input type="radio" name="keputusan" value="setuju" {{ old('keputusan') === 'setuju' ? 'checked' : '' }} />
                                <span>Setujui Pengajuan</span>
                            </label>
                            <label class="flex items-center gap-2">
                                <input type="radio" name="keputusan" value="tolak" {{ old('keputusan') === 'tolak' ? 'checked' : '' }} />
                                <span>Tolak Pengajuan</span>
                            </label>
                        </div>
                        @error('keputusan') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Catatan untuk mahasiswa (opsional)</label>
                        <textarea name="catatan_dosen" rows="4" class="w-full rounded-lg border-gray-300">{{ old('catatan_dosen', $pengajuan->catatan_dosen) }}</textarea>
                        @error('catatan_dosen') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <button type="submit" class="bg-[#1D9E75] hover:bg-[#188763] text-white px-5 py-2 rounded-lg">
                        Simpan Keputusan
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>