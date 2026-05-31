<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\services\SAWService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function __construct(protected SAWService $sawService) {}

    // -------------------------------------------------------
    //  DASHBOARD MAHASISWA
    // -------------------------------------------------------

    /**
     * Halaman dashboard mahasiswa:
     * Tampilkan status pengajuan aktif & skor SAW.
     */
    public function dashboard(): View
    {
        $user      = Auth::user();
        $mahasiswa = $user->mahasiswa;
        $pengajuan = $mahasiswa
            ? Pengajuan::with('penilaian.kriteria')
                ->where('mahasiswa_id', $mahasiswa->id)
                ->latest()
                ->first()
            : null;

        return view('mahasiswa.dashboard', compact('user', 'mahasiswa', 'pengajuan'));
    }

    // -------------------------------------------------------
    //  PENGAJUAN BEASISWA
    // -------------------------------------------------------

    /**
     * Tampilkan form pengajuan beasiswa baru.
     */
    public function formPengajuan(): View|RedirectResponse
    {
        $user      = Auth::user();
        $mahasiswa = $user->mahasiswa;

        // Cek apakah sudah punya pengajuan aktif
        if ($mahasiswa) {
            $pengajuanAktif = Pengajuan::where('mahasiswa_id', $mahasiswa->id)
                ->whereNotIn('status', [Pengajuan::STATUS_DITOLAK])
                ->exists();

            if ($pengajuanAktif) {
                return redirect()->route('mahasiswa.dashboard')
                    ->with('warning', 'Anda sudah memiliki pengajuan beasiswa yang sedang diproses.');
            }
        }

        return view('mahasiswa.daftar', compact('mahasiswa'));
    }

    /**
     * Simpan pengajuan baru ke database.
     */
    public function simpanPengajuan(Request $request): RedirectResponse
    {
        $request->validate([
            // Data profil mahasiswa
            'nim'              => ['required', 'string', 'max:20'],
            'prodi'            => ['required', 'string', 'max:100'],
            'angkatan'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'no_hp'            => ['required', 'string', 'max:20'],
            'alamat'           => ['required', 'string'],
            'penghasilan_ortu' => ['required', 'integer', 'min:0'],
            'ipk'              => ['required', 'numeric', 'min:0', 'max:4'],
            'prestasi'         => ['required', 'numeric', 'min:0', 'max:100'],
            'keaktifan_org'    => ['required', 'numeric', 'min:0', 'max:100'],
            // Dokumen wajib
            'dokumen_ktp'      => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'dokumen_kk'       => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'dokumen_sktm'     => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'dokumen_transkrip'=> ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            // Dokumen opsional
            'dokumen_prestasi' => ['nullable', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
        ]);

        $user = Auth::user();

        // Buat atau perbarui profil Mahasiswa
        $mahasiswa = Mahasiswa::updateOrCreate(
            ['user_id' => $user->id],
            [
                'nim'              => $request->nim,
                'prodi'            => $request->prodi,
                'angkatan'         => $request->angkatan,
                'no_hp'            => $request->no_hp,
                'alamat'           => $request->alamat,
                'penghasilan_ortu' => $request->penghasilan_ortu,
                'ipk'              => $request->ipk,
                'prestasi'         => $request->prestasi,
                'keaktifan_org'    => $request->keaktifan_org,
            ]
        );

        // Upload dokumen ke storage
        $dokumen = [];
        foreach (['dokumen_ktp', 'dokumen_kk', 'dokumen_sktm', 'dokumen_transkrip', 'dokumen_prestasi'] as $field) {
            if ($request->hasFile($field)) {
                $dokumen[$field] = $request->file($field)->store("dokumen/{$mahasiswa->id}", 'public');
            }
        }

        // Buat pengajuan baru
        Pengajuan::create(array_merge([
            'mahasiswa_id' => $mahasiswa->id,
            'status'       => Pengajuan::STATUS_MENUNGGU,
        ], $dokumen));

        return redirect()->route('mahasiswa.dashboard')
            ->with('success', 'Pengajuan beasiswa berhasil dikirim. Tunggu verifikasi dari dosen pembimbing.');
    }

    // -------------------------------------------------------
    //  LIHAT SKOR SAW PRIBADI
    // -------------------------------------------------------

    /**
     * Tampilkan detail skor SAW milik mahasiswa yang sedang login.
     */
    public function skorSaya(): View|RedirectResponse
    {
        $user      = Auth::user();
        $mahasiswa = $user->mahasiswa;

        if (! $mahasiswa) {
            return redirect()->route('mahasiswa.daftar')
                ->with('info', 'Silakan lengkapi data dan ajukan beasiswa terlebih dahulu.');
        }

        $pengajuan = Pengajuan::with('penilaian.kriteria')
            ->where('mahasiswa_id', $mahasiswa->id)
            ->whereNotNull('skor_saw')
            ->latest()
            ->first();

        if (! $pengajuan) {
            return redirect()->route('mahasiswa.dashboard')
                ->with('info', 'Skor SAW belum tersedia. Pengajuan Anda belum dihitung.');
        }

        // Hitung total peserta untuk menampilkan "ranking X dari Y"
        $totalPeserta = Pengajuan::whereNotNull('rank')->count();

        return view('mahasiswa.skor', compact('pengajuan', 'mahasiswa', 'totalPeserta'));
    }

    // -------------------------------------------------------
    //  STATUS PENGAJUAN
    // -------------------------------------------------------

    /**
     * Halaman progress pengajuan (stepper 3 langkah).
     */
    public function status(): View
    {
        $user      = Auth::user();
        $mahasiswa = $user->mahasiswa;

        $pengajuan = $mahasiswa
            ? Pengajuan::where('mahasiswa_id', $mahasiswa->id)->latest()->first()
            : null;

        return view('mahasiswa.status', compact('pengajuan', 'mahasiswa'));
    }
}