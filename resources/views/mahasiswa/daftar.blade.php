<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-semibold text-brand-navy">
            Pendaftaran Beasiswa
        </h2>
    </x-slot>

    <div class="py-8 px-6">
        <div class="bg-white rounded-xl shadow p-6 max-w-3xl mx-auto">

            <form method="POST" action="{{ route('mahasiswa.daftar.simpan') }}" enctype="multipart/form-data">
                @csrf

                <div class="grid gap-4">
                    <div>
                        <label class="block mb-2 font-medium">NIM</label>
                        <input name="nim" type="text" value="{{ old('nim', $mahasiswa?->nim) }}" class="w-full rounded-lg border-gray-300" />
                        @error('nim') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Program Studi</label>
                        <input name="prodi" type="text" value="{{ old('prodi', $mahasiswa?->prodi) }}" class="w-full rounded-lg border-gray-300" />
                        @error('prodi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Angkatan</label>
                        <input name="angkatan" type="number" value="{{ old('angkatan', $mahasiswa?->angkatan) }}" class="w-full rounded-lg border-gray-300" />
                        @error('angkatan') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">No. HP</label>
                        <input name="no_hp" type="text" value="{{ old('no_hp', $mahasiswa?->no_hp) }}" class="w-full rounded-lg border-gray-300" />
                        @error('no_hp') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Alamat</label>
                        <textarea name="alamat" class="w-full rounded-lg border-gray-300" rows="3">{{ old('alamat', $mahasiswa?->alamat) }}</textarea>
                        @error('alamat') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Penghasilan Orang Tua</label>
                        <input name="penghasilan_ortu" type="number" value="{{ old('penghasilan_ortu', $mahasiswa?->penghasilan_ortu) }}" class="w-full rounded-lg border-gray-300" />
                        @error('penghasilan_ortu') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">IPK</label>
                        <input name="ipk" type="text" value="{{ old('ipk', $mahasiswa?->ipk) }}" class="w-full rounded-lg border-gray-300" />
                        @error('ipk') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Prestasi</label>
                        <input name="prestasi" type="number" value="{{ old('prestasi', $mahasiswa?->prestasi) }}" class="w-full rounded-lg border-gray-300" />
                        @error('prestasi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Keaktifan Organisasi</label>
                        <input name="keaktifan_org" type="number" value="{{ old('keaktifan_org', $mahasiswa?->keaktifan_org) }}" class="w-full rounded-lg border-gray-300" />
                        @error('keaktifan_org') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Dokumen KTP</label>
                        <input name="dokumen_ktp" type="file" class="w-full rounded-lg border-gray-300" />
                        @error('dokumen_ktp') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Dokumen KK</label>
                        <input name="dokumen_kk" type="file" class="w-full rounded-lg border-gray-300" />
                        @error('dokumen_kk') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Dokumen SKTM</label>
                        <input name="dokumen_sktm" type="file" class="w-full rounded-lg border-gray-300" />
                        @error('dokumen_sktm') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Transkrip Nilai</label>
                        <input name="dokumen_transkrip" type="file" class="w-full rounded-lg border-gray-300" />
                        @error('dokumen_transkrip') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>

                    <div>
                        <label class="block mb-2 font-medium">Dokumen Prestasi (opsional)</label>
                        <input name="dokumen_prestasi" type="file" class="w-full rounded-lg border-gray-300" />
                        @error('dokumen_prestasi') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <button type="submit"
                    class="mt-6 bg-[#1D9E75] text-white px-6 py-2 rounded-lg hover:bg-[#188763]">
                    Kirim Pengajuan
                </button>
            </form>
        </div>
    </div>
</x-app-layout>