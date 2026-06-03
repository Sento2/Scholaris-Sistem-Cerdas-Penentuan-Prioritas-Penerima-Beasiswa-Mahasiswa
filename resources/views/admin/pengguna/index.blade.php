<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">Manajemen Pengguna</h2>
    </x-slot>

    <!-- Header Actions -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center animate-fade-in gap-4">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Daftar Pengguna</h2>
            <p class="text-gray-500 mt-1 text-sm font-medium">Kelola akun Admin, Dosen, dan Mahasiswa.</p>
        </div>
        <div class="flex items-center gap-3 w-full md:w-auto">
            <form method="GET" action="{{ route('admin.pengguna.index') }}" class="flex items-center gap-2">
                <select name="role" onchange="this.form.submit()" class="border-gray-200 text-gray-600 rounded-xl text-sm focus:ring-emerald-500 focus:border-emerald-500 py-2.5">
                    <option value="semua" {{ request('role') == 'semua' ? 'selected' : '' }}>Semua Role</option>
                    <option value="admin" {{ request('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="dosen" {{ request('role') == 'dosen' ? 'selected' : '' }}>Dosen</option>
                    <option value="mahasiswa" {{ request('role') == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                </select>
            </form>
            
            <a href="{{ route('admin.pengguna.create') }}" class="inline-flex justify-center items-center px-4 py-2.5 bg-emerald-600 border border-transparent text-white rounded-xl font-bold text-sm shadow-sm hover:bg-emerald-700 hover:shadow transition-all group whitespace-nowrap">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
                Tambah Pengguna
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 bg-emerald-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-xl flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium text-sm">{{ session('success') }}</span>
        </div>
    @endif

    <!-- Data Table -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 text-[12px] font-bold text-gray-500 uppercase tracking-wider border-b border-gray-100">
                        <th class="px-6 py-4">Nama & Email</th>
                        <th class="px-6 py-4 text-center">Role</th>
                        <th class="px-6 py-4">Keterangan</th>
                        <th class="px-6 py-4 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-[14px]">
                    @forelse($pengguna as $user)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4">
                                <div class="font-bold text-gray-800">{{ $user->name }}</div>
                                <div class="text-xs text-gray-500 mt-0.5">{{ $user->email }}</div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                @if($user->role === 'admin')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-purple-50 text-purple-700 border border-purple-100">Admin</span>
                                @elseif($user->role === 'dosen')
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-blue-50 text-blue-700 border border-blue-100">Dosen</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-md text-xs font-bold bg-emerald-50 text-emerald-700 border border-emerald-100">Mahasiswa</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">
                                @if($user->role === 'dosen' && $user->dosen)
                                    <div class="text-sm font-medium text-gray-700">NIP: {{ $user->dosen->nip ?? '-' }}</div>
                                @elseif($user->role === 'mahasiswa' && $user->mahasiswa)
                                    <div class="text-sm font-medium text-gray-700">NIM: {{ $user->mahasiswa->nim ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">Prodi: {{ $user->mahasiswa->prodi ?? '-' }} (Angk. {{ $user->mahasiswa->angkatan ?? '-' }})</div>
                                @else
                                    <span class="text-gray-400 text-xs italic">Staff Administrasi</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.pengguna.edit', $user->id) }}" class="p-2 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-lg transition-colors tooltip-trigger">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>
                                    
                                    @if($user->id !== auth()->id())
                                    <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pengguna ini? Semua data terkait (termasuk pengajuan/bimbingan) mungkin akan terhapus!');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 bg-red-50 hover:bg-red-100 rounded-lg transition-colors tooltip-trigger">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-12 text-center text-gray-500">Belum ada pengguna terdaftar.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($pengguna->hasPages())
            <div class="px-6 py-4 border-t border-gray-100">
                {{ $pengguna->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
