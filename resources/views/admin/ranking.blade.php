<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">Ranking SAW</h2>
    </x-slot>

    <!-- ACTIONS & KUOTA FORM -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8 mb-8 flex flex-col md:flex-row items-center justify-between gap-6 animate-slide-up">
        <div>
            <h3 class="text-lg font-bold text-gray-800">Eksekusi Perhitungan</h3>
            <p class="text-sm font-medium text-gray-500 mt-1">Hitung ulang skor SAW untuk semua pendaftar terverifikasi.</p>
        </div>
        <div class="flex flex-col sm:flex-row gap-4 w-full md:w-auto">
            <form action="{{ route('admin.ranking.hitung') }}" method="POST" class="w-full sm:w-auto">
                @csrf
                <button type="submit" class="w-full justify-center inline-flex items-center px-6 py-3 bg-white border border-emerald-600 text-emerald-700 rounded-xl font-bold text-sm hover:bg-emerald-50 transition-colors">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                    Hitung Ulang SAW
                </button>
            </form>
            
            <form action="{{ route('admin.ranking.tetapkan') }}" method="POST" class="flex gap-3 w-full sm:w-auto items-center">
                @csrf
                <div class="relative w-full sm:w-auto">
                    <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                        <span class="text-gray-500 font-bold text-sm">Kuota</span>
                    </div>
                    <input type="number" name="kuota" min="1" required class="block w-full sm:w-36 pl-16 pr-4 py-3 rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 text-sm font-bold transition-colors" placeholder="10">
                </div>
                <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-sm hover:bg-emerald-700 shadow-sm hover:shadow-md transition-all whitespace-nowrap">
                    Tetapkan Penerima
                </button>
            </form>
        </div>
    </div>

    <!-- MESSAGES -->
    @if (session('success'))
        <div class="bg-emerald-50 border-l-4 border-emerald-500 p-4 rounded-xl mb-8 flex items-center shadow-sm animate-fade-in">
            <svg class="h-5 w-5 text-emerald-500 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            <p class="text-sm font-bold text-emerald-800">{{ session('success') }}</p>
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-50 border-l-4 border-red-500 p-4 rounded-xl mb-8 flex items-center shadow-sm animate-fade-in">
            <svg class="h-5 w-5 text-red-500 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
            <p class="text-sm font-bold text-red-800">{{ session('error') }}</p>
        </div>
    @endif
    @if (session('info'))
        <div class="bg-blue-50 border-l-4 border-blue-500 p-4 rounded-xl mb-8 flex items-center shadow-sm animate-fade-in">
            <svg class="h-5 w-5 text-blue-500 mr-3" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
            <p class="text-sm font-bold text-blue-800">{{ session('info') }}</p>
        </div>
    @endif

    <!-- RANKING TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden animate-slide-up delay-100">
        <div class="px-8 py-6 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
            <h3 class="text-lg font-bold text-gray-800 flex items-center">
                <svg class="w-5 h-5 text-emerald-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z"></path></svg>
                Tabel Ranking Pendaftar
            </h3>
            <span class="text-xs font-bold text-gray-500 bg-white border border-gray-200 px-3 py-1.5 rounded-lg shadow-sm">Menampilkan {{ count($rankingList ?? []) }} mahasiswa</span>
        </div>
        
        <div class="overflow-x-auto p-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[12px] font-bold text-gray-500 uppercase tracking-wider border-b-2 border-gray-100">
                        <th class="px-6 py-4 w-24 text-center">Peringkat</th>
                        <th class="px-6 py-4">Nama Mahasiswa</th>
                        <th class="px-6 py-4">NIM / Prodi</th>
                        <th class="px-6 py-4 w-56 text-center">Skor SAW</th>
                        <th class="px-6 py-4 w-32 text-center">Status Final</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-[14px]">
                    @forelse ($rankingList ?? [] as $index => $pengajuan)
                        <tr class="hover:bg-gray-50 transition-colors {{ $index < 3 ? 'bg-emerald-50/30' : '' }}">
                            <td class="px-6 py-5 font-black text-gray-800 text-xl text-center">
                                @if($index == 0) <span class="text-yellow-500 flex justify-center items-center"><svg class="w-6 h-6 mr-1" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg> 1</span> 
                                @elseif($index == 1) <span class="text-gray-400">2</span>
                                @elseif($index == 2) <span class="text-amber-600">3</span>
                                @else {{ $pengajuan->rank ?? ($index + 1) }}
                                @endif
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-800">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-gray-700">{{ $pengajuan->mahasiswa->nim ?? '-' }}</div>
                                <div class="text-xs text-gray-500 font-medium mt-0.5">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="flex items-center justify-center">
                                    <span class="font-bold text-emerald-600 mr-3">{{ number_format($pengajuan->skor_saw ?? 0, 3) }}</span>
                                    <div class="w-24 bg-gray-200 rounded-full h-1.5">
                                        <div class="bg-emerald-500 h-1.5 rounded-full" style="width: {{ ($pengajuan->skor_saw ?? 0) * 100 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($pengajuan->status == 'diterima')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-800">Diterima</span>
                                @elseif($pengajuan->status == 'ditolak')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-red-100 text-red-800">Ditolak</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-gray-100 text-gray-700">{{ ucfirst($pengajuan->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500 font-medium">
                                <div class="flex flex-col justify-center items-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <p>Belum ada data ranking. Silakan lakukan perhitungan SAW terlebih dahulu.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-admin-layout>
