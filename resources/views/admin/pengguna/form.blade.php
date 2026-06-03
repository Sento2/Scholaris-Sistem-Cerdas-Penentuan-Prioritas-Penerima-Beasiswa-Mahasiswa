<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">
            {{ isset($pengguna) ? 'Edit Pengguna' : 'Tambah Pengguna Baru' }}
        </h2>
    </x-slot>

    <div class="mb-8 flex items-center gap-4 animate-fade-in">
        <a href="{{ route('admin.pengguna.index') }}" class="p-2 bg-white border border-gray-200 rounded-xl text-gray-500 hover:text-emerald-600 hover:border-emerald-200 transition-colors shadow-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
        </a>
        <div>
            <h2 class="text-2xl font-bold text-gray-800">{{ isset($pengguna) ? 'Edit Data Pengguna' : 'Tambah Data Pengguna' }}</h2>
            <p class="text-gray-500 mt-1 text-sm font-medium">Lengkapi formulir di bawah ini dengan data yang valid.</p>
        </div>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up">
        <form action="{{ isset($pengguna) ? route('admin.pengguna.update', $pengguna->id) : route('admin.pengguna.store') }}" method="POST" class="p-6 md:p-8">
            @csrf
            @if(isset($pengguna))
                @method('PUT')
            @endif

            <!-- Data Akun (User) -->
            <h3 class="text-lg font-bold text-gray-800 mb-4 pb-2 border-b border-gray-100">Informasi Akun (Wajib)</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div>
                    <label for="name" class="block text-sm font-bold text-gray-700 mb-1">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name', $pengguna->name ?? '') }}" required class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-bold text-gray-700 mb-1">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', $pengguna->email ?? '') }}" required class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    @error('email') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="password" class="block text-sm font-bold text-gray-700 mb-1">Password {{ isset($pengguna) ? '(Kosongkan jika tidak diubah)' : '' }}</label>
                    <input type="password" name="password" id="password" {{ isset($pengguna) ? '' : 'required' }} class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                    @error('password') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label for="role" class="block text-sm font-bold text-gray-700 mb-1">Role / Peran</label>
                    @if(isset($pengguna))
                        <!-- Jika Edit, tampilkan role tapi di-disable formnya (bisa pakai hidden input) karena ubah role beresiko relasi putus -->
                        <input type="text" value="{{ ucfirst($pengguna->role) }}" disabled class="w-full rounded-xl border-gray-200 bg-gray-100 text-gray-500 px-4 py-2.5 text-sm cursor-not-allowed">
                        <input type="hidden" name="role" value="{{ $pengguna->role }}" id="role-select">
                    @else
                        <select name="role" id="role-select" required class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            <option value="">-- Pilih Role --</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="dosen" {{ old('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                            <option value="mahasiswa" {{ old('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                        </select>
                        @error('role') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    @endif
                </div>
            </div>

            <!-- Bagian Dosen -->
            <div id="dosen-fields" class="mb-8" style="display: {{ (old('role', $pengguna->role ?? '') == 'dosen') ? 'block' : 'none' }}">
                <h3 class="text-lg font-bold text-blue-800 mb-4 pb-2 border-b border-blue-100 flex items-center">
                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2"></span> Profil Spesifik Dosen
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nip" class="block text-sm font-bold text-gray-700 mb-1">NIP (Nomor Induk Pegawai)</label>
                        <input type="text" name="nip" id="nip" value="{{ old('nip', $pengguna->dosen->nip ?? '') }}" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        @error('nip') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <!-- Bagian Mahasiswa -->
            <div id="mahasiswa-fields" class="mb-8" style="display: {{ (old('role', $pengguna->role ?? '') == 'mahasiswa') ? 'block' : 'none' }}">
                <h3 class="text-lg font-bold text-emerald-800 mb-4 pb-2 border-b border-emerald-100 flex items-center">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 mr-2"></span> Profil Spesifik Mahasiswa
                </h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label for="nim" class="block text-sm font-bold text-gray-700 mb-1">NIM (Nomor Induk Mahasiswa)</label>
                        <input type="text" name="nim" id="nim" value="{{ old('nim', $pengguna->mahasiswa->nim ?? '') }}" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        @error('nim') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="prodi" class="block text-sm font-bold text-gray-700 mb-1">Program Studi</label>
                        <select name="prodi" id="prodi" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            <option value="">-- Pilih Prodi --</option>
                            <option value="Informatika" {{ old('prodi', $pengguna->mahasiswa->prodi ?? '') == 'Informatika' ? 'selected' : '' }}>Informatika</option>
                            <option value="Sistem Informasi" {{ old('prodi', $pengguna->mahasiswa->prodi ?? '') == 'Sistem Informasi' ? 'selected' : '' }}>Sistem Informasi</option>
                            <option value="Teknologi Informasi" {{ old('prodi', $pengguna->mahasiswa->prodi ?? '') == 'Teknologi Informasi' ? 'selected' : '' }}>Teknologi Informasi</option>
                        </select>
                        @error('prodi') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="angkatan" class="block text-sm font-bold text-gray-700 mb-1">Angkatan (Tahun)</label>
                        <input type="number" name="angkatan" id="angkatan" min="2015" max="{{ date('Y')+1 }}" value="{{ old('angkatan', $pengguna->mahasiswa->angkatan ?? '') }}" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                        @error('angkatan') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                    
                    <div>
                        <label for="dosen_id" class="block text-sm font-bold text-gray-700 mb-1">Dosen Pembimbing</label>
                        <select name="dosen_id" id="dosen_id" class="w-full rounded-xl border-gray-200 bg-gray-50 px-4 py-2.5 text-sm focus:bg-white focus:ring-emerald-500 focus:border-emerald-500 transition-colors">
                            <option value="">-- Pilih Dosen --</option>
                            @foreach($dosens as $dosen)
                                <option value="{{ $dosen->id }}" {{ old('dosen_id', $pengguna->mahasiswa->dosen_id ?? '') == $dosen->id ? 'selected' : '' }}>
                                    {{ $dosen->user->name ?? 'Unknown' }}
                                </option>
                            @endforeach
                        </select>
                        @error('dosen_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                    </div>
                </div>
            </div>

            <div class="flex justify-end pt-6 border-t border-gray-100">
                <a href="{{ route('admin.pengguna.index') }}" class="px-6 py-2.5 bg-white border border-gray-200 text-gray-700 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all mr-3">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2.5 bg-emerald-600 border border-transparent text-white rounded-xl font-bold text-sm shadow-sm hover:bg-emerald-700 hover:shadow transition-all">
                    {{ isset($pengguna) ? 'Simpan Perubahan' : 'Simpan Pengguna Baru' }}
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role-select');
            const dosenFields = document.getElementById('dosen-fields');
            const mahasiswaFields = document.getElementById('mahasiswa-fields');

            function toggleFields() {
                const role = roleSelect.value;
                if (role === 'dosen') {
                    dosenFields.style.display = 'block';
                    mahasiswaFields.style.display = 'none';
                } else if (role === 'mahasiswa') {
                    dosenFields.style.display = 'none';
                    mahasiswaFields.style.display = 'block';
                } else {
                    dosenFields.style.display = 'none';
                    mahasiswaFields.style.display = 'none';
                }
            }

            // Bind event listener
            roleSelect.addEventListener('change', toggleFields);
            
            // Initial call in case of old input errors
            toggleFields();
        });
    </script>
    @endpush
</x-admin-layout>
