<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">Kriteria & Bobot</h2>
    </x-slot>

    <!-- TOTAL BOBOT ALERT -->
    @php
        $isTotalValid = abs(($totalBobot ?? 0) - 100) < 0.01;
    @endphp
    <div class="rounded-xl border-l-4 p-5 flex items-start mb-8 animate-slide-up shadow-sm {{ $isTotalValid ? 'bg-[#f0fdf4] border-emerald-500' : 'bg-red-50 border-red-500' }}">
        <div class="flex-shrink-0 mt-0.5">
            @if($isTotalValid)
                <div class="w-8 h-8 rounded-full bg-emerald-100 text-emerald-600 flex items-center justify-center">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                </div>
            @else
                <div class="w-8 h-8 rounded-full bg-red-100 text-red-600 flex items-center justify-center">
                    <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                </div>
            @endif
        </div>
        <div class="ml-4">
            <h3 class="text-base font-bold {{ $isTotalValid ? 'text-emerald-800' : 'text-red-800' }}">
                Total Bobot Saat Ini: {{ $totalBobot ?? 0 }}%
            </h3>
            <div class="mt-1 text-sm font-medium {{ $isTotalValid ? 'text-emerald-600' : 'text-red-600' }}">
                @if($isTotalValid)
                    <p>Sistem SAW sudah siap digunakan untuk perhitungan ranking.</p>
                @else
                    <p>Total bobot kriteria wajib bernilai tepat 100%. Harap sesuaikan kembali bobot di bawah.</p>
                @endif
            </div>
        </div>
    </div>

    <!-- MESSAGES -->
    @if (session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl mb-8 flex items-center shadow-sm animate-fade-in">
            <svg class="h-5 w-5 text-emerald-500 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif

    <!-- MAIN GRID -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        
        <!-- UPDATE FORM (LEFT/MAIN) -->
        <div class="lg:col-span-2">
            <form action="{{ route('admin.bobot.simpan') }}" method="POST">
                @csrf
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-100">
                    <div class="px-8 py-6 border-b border-gray-100 flex flex-col sm:flex-row sm:justify-between sm:items-center bg-gray-50/50">
                        <div class="mb-4 sm:mb-0">
                            <h3 class="text-lg font-bold text-gray-800">Daftar Kriteria Penilaian</h3>
                            <p class="text-xs text-gray-500 mt-1 font-medium">Sesuaikan nilai bobot dan jenis kriteria (Benefit/Cost).</p>
                        </div>
                        <button type="submit" class="inline-flex items-center justify-center px-6 py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-emerald-700 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:ring-offset-2 transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                    
                    <div class="overflow-x-auto p-2">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="text-[12px] font-bold text-gray-500 uppercase tracking-wider border-b-2 border-gray-100">
                                    <th class="px-6 py-4">Kriteria</th>
                                    <th class="px-6 py-4 w-32">Bobot (%)</th>
                                    <th class="px-6 py-4 w-40">Jenis</th>
                                    <th class="px-6 py-4 w-20 text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50 text-[14px]">
                                @forelse ($kriteriaList ?? [] as $index => $kriteria)
                                    <tr class="hover:bg-gray-50 transition-colors group">
                                        <td class="px-6 py-5">
                                            <input type="hidden" name="kriteria[{{ $index }}][id]" value="{{ $kriteria->id }}">
                                            <div class="font-bold text-gray-800 flex items-center">
                                                <span class="h-6 px-2 rounded-md bg-gray-100 text-gray-500 flex items-center justify-center text-[10px] uppercase tracking-widest mr-3 font-bold whitespace-nowrap">{{ $kriteria->kode ?? 'C'.($index+1) }}</span>
                                                {{ $kriteria->nama }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-5">
                                            <input type="number" step="0.01" name="kriteria[{{ $index }}][bobot]" value="{{ $kriteria->bobot }}" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm font-bold text-gray-700 transition-colors" required>
                                        </td>
                                        <td class="px-6 py-5">
                                            <select name="kriteria[{{ $index }}][jenis]" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm font-bold text-gray-700 transition-colors">
                                                <option value="benefit" {{ $kriteria->jenis == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                                <option value="cost" {{ $kriteria->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                                            </select>
                                        </td>
                                        <td class="px-6 py-5 text-center">
                                            <button type="button" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus kriteria ini?')) document.getElementById('delete-form-{{ $kriteria->id }}').submit();" class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:bg-red-50 hover:text-red-600 transition-colors mx-auto">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            </button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-10 text-center text-gray-500 font-medium">
                                            Belum ada kriteria penilaian.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </form>
            
            <!-- Hidden delete forms -->
            @foreach($kriteriaList ?? [] as $kriteria)
                <form id="delete-form-{{ $kriteria->id }}" action="{{ route('admin.bobot.hapus', $kriteria->id) }}" method="POST" class="hidden">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </div>

        <!-- ADD FORM (RIGHT/SIDEBAR) -->
        <div>
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-200 sticky top-24">
                <div class="px-8 py-6 border-b border-gray-100 bg-gray-50/50">
                    <h3 class="text-lg font-bold text-gray-800 flex items-center">
                        <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Tambah Kriteria Baru
                    </h3>
                </div>
                <form action="{{ route('admin.bobot.tambah') }}" method="POST" class="p-8 space-y-5">
                    @csrf
                    
                    <div>
                        <label for="kode" class="block text-sm font-bold text-gray-700 mb-1">Kode Kriteria</label>
                        <input type="text" name="kode" id="kode" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm transition-colors" placeholder="Contoh: C5" required>
                    </div>

                    <div>
                        <label for="nama" class="block text-sm font-bold text-gray-700 mb-1">Nama Kriteria</label>
                        <input type="text" name="nama" id="nama" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm transition-colors" placeholder="Contoh: Prestasi" required>
                    </div>

                    <div>
                        <label for="bobot" class="block text-sm font-bold text-gray-700 mb-1">Bobot (%)</label>
                        <input type="number" step="0.01" name="bobot" id="bobot" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm transition-colors" placeholder="Contoh: 15" required>
                    </div>

                    <div>
                        <label for="jenis" class="block text-sm font-bold text-gray-700 mb-1">Jenis Kriteria</label>
                        <select name="jenis" id="jenis" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm font-bold text-gray-700 transition-colors">
                            <option value="benefit">Benefit (Makin besar makin baik)</option>
                            <option value="cost">Cost (Makin kecil makin baik)</option>
                        </select>
                    </div>
                    
                    <div>
                        <label for="keterangan" class="block text-sm font-bold text-gray-700 mb-1">Keterangan <span class="font-normal text-gray-400">(Opsional)</span></label>
                        <textarea name="keterangan" id="keterangan" rows="3" class="block w-full rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm transition-colors"></textarea>
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border-2 border-emerald-600 text-emerald-700 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">
                            Tambah Kriteria
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-admin-layout>
