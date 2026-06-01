<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProsesVerifikasiRequest;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DosenController extends Controller
{
    // -------------------------------------------------------
    //  DAFTAR MAHASISWA BIMBINGAN
    // -------------------------------------------------------

    /**
     * Tampilkan semua mahasiswa bimbingan dosen yang sedang login,
     * lengkap dengan status pengajuan beasiswa terbaru mereka.
     */
    public function bimbingan(): View
    {
        $dosen = Auth::user();
        $dosenId = $dosen->dosen?->id;

        // Ambil semua mahasiswa bimbingan beserta pengajuan terbaru
        $mahasiswaList = Mahasiswa::with(['user', 'pengajuanAktif'])
            ->where('dosen_id', $dosenId)
            ->get();

        // Statistik ringkas untuk tampilan header
        $stats = [
            'total'         => $mahasiswaList->count(),
            'menunggu'      => $mahasiswaList->filter(fn($m) =>
                $m->pengajuanAktif?->status === Pengajuan::STATUS_MENUNGGU)->count(),
            'sudah_verif'   => $mahasiswaList->filter(fn($m) =>
                $m->pengajuanAktif?->status === Pengajuan::STATUS_DIVERIFIKASI)->count(),
            'selesai'       => $mahasiswaList->filter(fn($m) =>
                in_array($m->pengajuanAktif?->status, [
                    Pengajuan::STATUS_DITERIMA,
                    Pengajuan::STATUS_DITOLAK,
                ]))->count(),
        ];

        return view('dosen.bimbingan', compact('mahasiswaList', 'stats', 'dosen'));
    }

    // -------------------------------------------------------
    //  FORM VERIFIKASI
    // -------------------------------------------------------

    /**
     * Tampilkan detail pengajuan mahasiswa untuk diverifikasi.
     */
    public function formVerifikasi(int $pengajuanId): View|RedirectResponse
    {
        $dosen    = Auth::user();
        $pengajuan = Pengajuan::with(['mahasiswa.user'])
            ->find($pengajuanId);

        $dosenId = $dosen->dosen?->id;

        // Pastikan mahasiswa ini bimbingan dosen yang sedang login
        if (! $pengajuan || $pengajuan->mahasiswa->dosen_id !== $dosenId) {
            return redirect()->route('dosen.bimbingan')
                ->with('error', 'Pengajuan tidak ditemukan atau bukan mahasiswa bimbingan Anda.');
        }

        return view('dosen.verifikasi', compact('pengajuan', 'dosen'));
    }

    /**
     * Proses verifikasi: setujui atau tolak pengajuan mahasiswa.
     */
    public function prosesVerifikasi(ProsesVerifikasiRequest $request, int $pengajuanId): RedirectResponse
    {
        $dosen    = Auth::user();
        $pengajuan = Pengajuan::with('mahasiswa')->find($pengajuanId);

        $dosenId = $dosen->dosen?->id;

        // Validasi kepemilikan
        if (! $pengajuan || $pengajuan->mahasiswa->dosen_id !== $dosenId) {
            return redirect()->route('dosen.bimbingan')
                ->with('error', 'Aksi tidak diizinkan.');
        }

        // Pastikan pengajuan masih dalam status menunggu
        if ($pengajuan->status !== Pengajuan::STATUS_MENUNGGU) {
            return redirect()->route('dosen.bimbingan')
                ->with('warning', 'Pengajuan ini sudah diproses sebelumnya.');
        }

        $statusBaru = $request->keputusan === 'setuju'
            ? Pengajuan::STATUS_DIVERIFIKASI
            : Pengajuan::STATUS_DITOLAK;

        $pengajuan->update([
            'status'          => $statusBaru,
            'catatan_dosen'   => $request->catatan_dosen,
            'diverifikasi_at' => now(),
        ]);

        $pesan = $request->keputusan === 'setuju'
            ? 'Pengajuan berhasil diverifikasi dan siap untuk dihitung SAW.'
            : 'Pengajuan ditolak dan mahasiswa akan diberitahu.';

        return redirect()->route('dosen.bimbingan')->with('success', $pesan);
    }

    // -------------------------------------------------------
    //  LAPORAN
    // -------------------------------------------------------

    /**
     * Laporan distribusi hasil beasiswa untuk mahasiswa bimbingan dosen ini.
     */
    public function laporan(): View
    {
        $dosen = Auth::user();
        $dosenId = $dosen->dosen?->id;

        $mahasiswaList = Mahasiswa::with(['user', 'pengajuan' => fn($q) =>
            $q->whereNotNull('skor_saw')->orderBy('rank')
        ])
            ->where('dosen_id', $dosenId)
            ->get();

        return view('dosen.laporan', compact('mahasiswaList', 'dosen'));
    }
}