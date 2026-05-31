<x-app-layout>
    <x-slot name="header">
        <h2 class="font-serif font-bold text-3xl text-brand-navy leading-tight">
            {{ __('Data Seluruh Pendaftar') }}
        </h2>
        <p class="text-gray-500 mt-1">Kelola dan pantau seluruh pengajuan beasiswa mahasiswa.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <!-- FILTER BAR -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-4">
                <form action="{{ route('admin.data') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
                    <div class="w-full md:w-1/3 relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg class="w-4 h-4 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="cari" value="{{ request('cari') }}" class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm" placeholder="Cari nama atau NIM...">
                    </div>
                    
                    <div class="w-full md:w-auto flex flex-col sm:flex-row gap-4">
                        <select name="status" class="block w-full sm:w-48 rounded-md border-gray-300 shadow-sm focus:border-brand-teal focus:ring-brand-teal sm:text-sm">
                            <option value="">Semua Status</option>
                            @foreach($statusList ?? [] as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                        
                        <div class="flex gap-2">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-brand-navy border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest shadow-sm hover:bg-opacity-90 focus:outline-none focus:ring-2 focus:ring-brand-navy focus:ring-offset-2 transition ease-in-out duration-150">
                                Filter
                            </button>
                            @if(request('cari') || request('status'))
                                <a href="{{ route('admin.data') }}" class="inline-flex justify-center items-center px-4 py-2 bg-white border border-gray-300 text-gray-700 rounded-md font-semibold text-xs uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-brand-teal focus:ring-offset-2 transition ease-in-out duration-150">
                                    Reset
                                </a>
                            @endif
                        </div>
                    </div>
                </form>
            </div>

            <!-- DATA TABLE -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-surface">
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Tanggal Pengajuan</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Mahasiswa</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Prodi / Angkatan</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Skor SAW</th>
                                <th class="px-6 py-4 text-sm font-medium text-gray-500 border-b border-gray-100">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse ($pengajuanList ?? [] as $pengajuan)
                                <tr class="hover:bg-gray-50 transition">
                                    <td class="px-6 py-4 text-sm text-gray-500">
                                        {{ $pengajuan->created_at ? $pengajuan->created_at->format('d M Y, H:i') : '-' }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="font-medium text-brand-navy">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                                        <div class="text-xs text-gray-500">{{ $pengajuan->mahasiswa->nim ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm text-brand-navy">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                        <div class="text-xs text-gray-500">Angkatan {{ $pengajuan->mahasiswa->angkatan ?? '-' }}</div>
                                    </td>
                                    <td class="px-6 py-4 font-bold text-brand-navy">
                                        {{ $pengajuan->skor_saw ? number_format($pengajuan->skor_saw, 3) : '-' }}
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
                                        @elseif($pengajuan->status == 'diverifikasi' || $pengajuan->status == 'dihitung')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-brand-teal bg-opacity-10 text-brand-teal border border-brand-teal border-opacity-20">
                                                {{ ucfirst($pengajuan->status) }}
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-status-warning bg-opacity-10 text-status-warning border border-status-warning border-opacity-20">
                                                {{ ucfirst($pengajuan->status) }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center justify-center">
                                            <svg class="h-12 w-12 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                                            <p>Tidak ada data pengajuan yang ditemukan.</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                @if(isset($pengajuanList) && $pengajuanList->hasPages())
                    <div class="px-6 py-4 border-t border-gray-100">
                        {{ $pengajuanList->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
