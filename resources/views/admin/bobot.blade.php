<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-3xl text-brand-navy leading-tight">
            {{ __('Pengaturan Bobot Kriteria') }}
        </h2>
        <p class="text-gray-500 mt-1">Konfigurasi parameter penilaian Simple Additive Weighting (SAW).</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <!-- TOTAL BOBOT ALERT -->
            @php
                $isTotalValid = abs(($totalBobot ?? 0) - 100) < 0.01;
            @endphp
            <div class="rounded-xl border-l-4 p-4 flex items-start {{ $isTotalValid ? 'bg-status-success bg-opacity-10 border-status-success' : 'bg-status-danger bg-opacity-10 border-status-danger' }}">
                <div class="flex-shrink-0 mt-0.5">
                    @if($isTotalValid)
                        <svg class="h-5 w-5 text-status-success" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    @else
                        <svg class="h-5 w-5 text-status-danger" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    @endif
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium {{ $isTotalValid ? 'text-status-success' : 'text-status-danger' }}">
                        Total Bobot Saat Ini: {{ $totalBobot ?? 0 }}%
                    </h3>
                    <div class="mt-1 text-sm {{ $isTotalValid ? 'text-status-success' : 'text-status-danger' }} opacity-80">
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
                <div class="bg-status-success bg-opacity-10 border-l-4 border-status-success p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-status-success" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-status-success font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- MAIN GRID -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                
                <!-- UPDATE FORM (LEFT/MAIN) -->
                <div class="lg:col-span-2">
                    <form action="{{ route('admin.bobot.simpan') }}" method="POST">
                        @csrf
                        <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                            <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center bg-surface">
                                <div>
                                    <h3 class="text-lg font-semibold text-brand-navy">Daftar Kriteria Penilaian</h3>
                                    <p class="text-xs text-gray-500 mt-1">Sesuaikan nilai bobot dan jenis kriteria.</p>
                                </div>
                                <button type="submit" class="inline-flex items-center px-4 py-2 bg-brand-teal border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:ring-offset-2 transition ease-in-out duration-150">
                                    Simpan Perubahan
                                </button>
                            </div>
                            <div class="overflow-x-auto">
                                <table class="w-full text-left border-collapse">
                                    <thead>
                                        <tr class="bg-white border-b border-gray-100">
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider">Kriteria</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider w-32">Bobot (%)</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider w-40">Jenis</th>
                                            <th class="px-6 py-3 text-xs font-medium text-gray-500 uppercase tracking-wider w-20 text-right">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-gray-100">
                                        @forelse ($kriteriaList ?? [] as $index => $kriteria)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-4">
                                                    <input type="hidden" name="kriteria[{{ $index }}][id]" value="{{ $kriteria->id }}">
                                                    <div class="font-medium text-brand-navy">{{ $kriteria->nama }}</div>
                                                    <div class="text-xs text-gray-500">{{ $kriteria->kode ?? 'K'.($index+1) }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <input type="number" step="0.01" name="kriteria[{{ $index }}][bobot]" value="{{ $kriteria->bobot }}" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm" required>
                                                </td>
                                                <td class="px-6 py-4">
                                                    <select name="kriteria[{{ $index }}][jenis]" class="block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm">
                                                        <option value="benefit" {{ $kriteria->jenis == 'benefit' ? 'selected' : '' }}>Benefit</option>
                                                        <option value="cost" {{ $kriteria->jenis == 'cost' ? 'selected' : '' }}>Cost</option>
                                                    </select>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                    <button type="button" onclick="event.preventDefault(); if(confirm('Yakin ingin menghapus kriteria ini?')) document.getElementById('delete-form-{{ $kriteria->id }}').submit();" class="text-status-danger hover:text-red-700 transition">
                                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                    </button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">
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
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                        <div class="px-6 py-5 border-b border-gray-100 bg-surface">
                            <h3 class="text-lg font-semibold text-brand-navy">Tambah Kriteria Baru</h3>
                        </div>
                        <form action="{{ route('admin.bobot.tambah') }}" method="POST" class="p-6 space-y-4">
                            @csrf
                            
                            <div>
                                <label for="kode" class="block text-sm font-medium text-brand-navy">Kode Kriteria</label>
                                <input type="text" name="kode" id="kode" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm" placeholder="C1" required>
                            </div>

                            <div>
                                <label for="nama" class="block text-sm font-medium text-brand-navy">Nama Kriteria</label>
                                <input type="text" name="nama" id="nama" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm" placeholder="IPK Semester" required>
                            </div>

                            <div>
                                <label for="bobot" class="block text-sm font-medium text-brand-navy">Bobot (%)</label>
                                <input type="number" step="0.01" name="bobot" id="bobot" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm" placeholder="20" required>
                            </div>

                            <div>
                                <label for="jenis" class="block text-sm font-medium text-brand-navy">Jenis Kriteria</label>
                                <select name="jenis" id="jenis" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm">
                                    <option value="benefit">Benefit (Semakin besar semakin baik)</option>
                                    <option value="cost">Cost (Semakin kecil semakin baik)</option>
                                </select>
                            </div>
                            
                            <div>
                                <label for="keterangan" class="block text-sm font-medium text-brand-navy">Keterangan (Opsional)</label>
                                <textarea name="keterangan" id="keterangan" rows="2" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm"></textarea>
                            </div>

                            <div class="pt-2">
                                <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-brand-teal text-brand-teal rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-brand-teal hover:bg-opacity-5 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:ring-offset-2 transition ease-in-out duration-150">
                                    Tambah Kriteria
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
