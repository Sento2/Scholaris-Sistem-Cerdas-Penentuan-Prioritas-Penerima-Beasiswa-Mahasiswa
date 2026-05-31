<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-3xl text-brand-navy leading-tight">
            {{ __('Ranking Hasil SAW') }}
        </h2>
        <p class="text-gray-500 mt-1">Sistem Perhitungan Simple Additive Weighting untuk menentukan penerima beasiswa.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- ACTIONS & KUOTA FORM -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 flex flex-col md:flex-row items-center justify-between gap-4">
                <div>
                    <h3 class="text-lg font-semibold text-brand-navy">Eksekusi Perhitungan</h3>
                    <p class="text-sm text-gray-500">Hitung ulang skor SAW untuk semua pendaftar terverifikasi.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3">
                    <form action="{{ route('admin.ranking.hitung') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full inline-flex justify-center items-center px-4 py-2 bg-white border border-brand-teal text-brand-teal rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-brand-teal hover:bg-opacity-5 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:ring-offset-2 transition ease-in-out duration-150">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                            Hitung Ulang SAW
                        </button>
                    </form>
                    
                    <form action="{{ route('admin.ranking.tetapkan') }}" method="POST" class="flex gap-2 items-center">
                        @csrf
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <span class="text-gray-500 sm:text-sm">Kuota</span>
                            </div>
                            <input type="number" name="kuota" min="1" required class="block w-32 pl-14 rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm" placeholder="10">
                        </div>
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-brand-teal border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:ring-offset-2 transition ease-in-out duration-150">
                            Tetapkan Penerima
                        </button>
                    </form>
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

            @if (session('error'))
                <div class="bg-status-danger bg-opacity-10 border-l-4 border-status-danger p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-status-danger" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-status-danger font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if (session('info'))
                <div class="bg-brand-navy bg-opacity-10 border-l-4 border-brand-navy p-4 rounded-md">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-brand-navy" viewBox="0 0 20 20" fill="currentColor"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"/></svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-brand-navy font-medium">{{ session('info') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- RANKING TABLE -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-semibold text-brand-navy">Tabel Ranking Pendaftar</h3>
                    <span class="text-sm text-gray-500">Menampilkan {{ count($rankingList ?? []) }} mahasiswa</span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface">
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100 w-24">Peringkat</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Nama Mahasiswa</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">NIM / Prodi</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100 w-48">Skor SAW</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100 w-32">Status Final</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($rankingList ?? [] as $index => $pengajuan)
                                <tr class="hover:bg-gray-50 transition {{ $index < 3 ? 'bg-brand-teal bg-opacity-5' : '' }}">
                                    <td class="px-6 py-4 font-bold text-brand-navy text-lg text-center">
                                        @if($index == 0) <span class="text-yellow-500 text-xl">🏆</span> 
                                        @elseif($index == 1) <span class="text-gray-400 text-xl">🥈</span>
                                        @elseif($index == 2) <span class="text-amber-600 text-xl">🥉</span>
                                        @else #{{ $pengajuan->rank ?? ($index + 1) }}
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-brand-navy">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-brand-navy">{{ $pengajuan->mahasiswa->nim ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            <span class="font-bold text-brand-navy w-12">{{ number_format($pengajuan->skor_saw ?? 0, 3) }}</span>
                                            <div class="w-full bg-gray-200 rounded-full h-2 ml-2">
                                                <div class="bg-brand-teal h-2 rounded-full" style="width: {{ ($pengajuan->skor_saw ?? 0) * 100 }}%"></div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($pengajuan->status == 'diterima')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-success bg-opacity-10 text-status-success border border-status-success border-opacity-20">
                                                Diterima
                                            </span>
                                        @elseif($pengajuan->status == 'ditolak')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-danger bg-opacity-10 text-status-danger border border-status-danger border-opacity-20">
                                                Ditolak
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800 border border-gray-200">
                                                {{ ucfirst($pengajuan->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                        <p class="mt-4 text-sm">Belum ada data ranking. Silakan lakukan perhitungan SAW terlebih dahulu.</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
