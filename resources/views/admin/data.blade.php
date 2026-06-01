<x-admin-layout>
    <x-slot name="header">
        <h2 class="text-xl font-extrabold text-gray-800 hidden md:block">Kelola Pengajuan</h2>
    </x-slot>

    <!-- FILTER BAR -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 mb-8">
        <form action="{{ route('admin.data') }}" method="GET" class="flex flex-col md:flex-row gap-4 items-center justify-between">
            <div class="w-full md:w-1/3 relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <input type="text" name="cari" value="{{ request('cari') }}" class="block w-full pl-12 pr-4 py-3 rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-colors text-sm font-medium" placeholder="Cari nama atau NIM...">
            </div>
            
            <div class="w-full md:w-auto flex flex-col sm:flex-row gap-4">
                <select name="status" class="block w-full sm:w-48 py-3 rounded-xl border-gray-200 shadow-sm focus:border-emerald-500 focus:ring focus:ring-emerald-200 focus:ring-opacity-50 transition-colors text-sm font-medium text-gray-600">
                    <option value="">Semua Status</option>
                    @foreach($statusList ?? [] as $status)
                        <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                            {{ ucfirst($status) }}
                        </option>
                    @endforeach
                </select>
                
                <div class="flex gap-3">
                    <button type="submit" class="inline-flex justify-center items-center px-6 py-3 bg-emerald-600 text-white rounded-xl font-bold text-sm shadow-sm hover:bg-emerald-700 hover:shadow-md transition-all">
                        Filter
                    </button>
                    @if(request('cari') || request('status'))
                        <a href="{{ route('admin.data') }}" class="inline-flex justify-center items-center px-6 py-3 bg-white border border-gray-200 text-gray-700 rounded-xl font-bold text-sm shadow-sm hover:bg-gray-50 transition-all">
                            Reset
                        </a>
                    @endif
                </div>
            </div>
        </form>
    </div>

    <!-- DATA TABLE -->
    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto p-2">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="text-[12px] font-bold text-gray-500 uppercase tracking-wider border-b-2 border-gray-100">
                        <th class="px-6 py-4">Tanggal Pengajuan</th>
                        <th class="px-6 py-4">Mahasiswa</th>
                        <th class="px-6 py-4">Prodi / Angkatan</th>
                        <th class="px-6 py-4 text-center">Skor SAW</th>
                        <th class="px-6 py-4 text-center">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50 text-[14px]">
                    @forelse ($pengajuanList ?? [] as $pengajuan)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-5 text-gray-500 font-medium text-sm">
                                {{ $pengajuan->created_at ? $pengajuan->created_at->format('d M Y, H:i') : '-' }}
                            </td>
                            <td class="px-6 py-5">
                                <div class="font-bold text-gray-800">{{ $pengajuan->mahasiswa->user->name ?? 'Unknown' }}</div>
                                <div class="text-xs text-gray-500 font-medium mt-0.5">{{ $pengajuan->mahasiswa->nim ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5">
                                <div class="text-sm font-bold text-gray-700">{{ $pengajuan->mahasiswa->prodi ?? '-' }}</div>
                                <div class="text-xs text-gray-500 font-medium mt-0.5">Angkatan {{ $pengajuan->mahasiswa->angkatan ?? '-' }}</div>
                            </td>
                            <td class="px-6 py-5 text-center font-bold text-emerald-600">
                                {{ $pengajuan->skor_saw ? number_format($pengajuan->skor_saw, 3) : '-' }}
                            </td>
                            <td class="px-6 py-5 text-center">
                                @if($pengajuan->status == 'diterima')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-emerald-100 text-emerald-800">Diterima</span>
                                @elseif($pengajuan->status == 'ditolak')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-red-100 text-red-800">Ditolak</span>
                                @elseif($pengajuan->status == 'menunggu')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-[#fde68a] text-[#92400e]">Menunggu</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-bold bg-blue-50 text-blue-700">{{ ucfirst($pengajuan->status) }}</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-16 text-center text-gray-500">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                                        <svg class="h-8 w-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                    </div>
                                    <p class="font-bold text-gray-700">Tidak ada data pengajuan yang ditemukan.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        @if(isset($pengajuanList) && $pengajuanList->hasPages())
            <div class="px-6 py-4 border-t border-gray-100 bg-gray-50/50">
                {{ $pengajuanList->links() }}
            </div>
        @endif
    </div>
</x-admin-layout>
