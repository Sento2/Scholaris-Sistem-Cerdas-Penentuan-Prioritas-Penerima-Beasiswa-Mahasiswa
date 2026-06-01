<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePengajuanRequest;
use App\Http\Requests\UpdateProfilRequest;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\User;
use App\services\SAWService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class MahasiswaController extends Controller
{
    public function __construct(protected SAWService $sawService) {}

    private function currentUser(): User
    {
        $user = Auth::user();

        abort_unless($user instanceof User, 403);

        return $user;
    }

    // -------------------------------------------------------
    //  DASHBOARD MAHASISWA
    // -------------------------------------------------------

    /**
     * Halaman dashboard mahasiswa:
     * Tampilkan status pengajuan aktif & skor SAW.
     */
    public function dashboard(): View
    {
        $user      = $this->currentUser();
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
     * Tampilkan daftar beasiswa yang tersedia.
     */
    public function beasiswa(): View
    {
        $beasiswas = \App\Models\Beasiswa::where('status', 'aktif')->get();
        return view('mahasiswa.beasiswa', compact('beasiswas'));
    }

    /**
     * Tampilkan form pengajuan beasiswa baru.
     */
    public function formPengajuan(): View|RedirectResponse
    {
        $user      = $this->currentUser();
        $mahasiswa = $user->mahasiswa;
        $pengajuanAktif = false;

        // Cek apakah sudah punya pengajuan aktif
        if ($mahasiswa) {
            $pengajuanAktif = Pengajuan::where('mahasiswa_id', $mahasiswa->id)
                ->whereNotIn('status', [Pengajuan::STATUS_DITOLAK])
                ->exists();
        }

        return view('mahasiswa.daftar', compact('mahasiswa', 'pengajuanAktif'));
    }

    /**
     * Simpan pengajuan baru ke database.
     */
    public function simpanPengajuan(StorePengajuanRequest $request): RedirectResponse
    {

        $user = $this->currentUser();

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
        $user      = $this->currentUser();
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
        $user      = $this->currentUser();
        $mahasiswa = $user->mahasiswa;

        $pengajuan = $mahasiswa
            ? Pengajuan::where('mahasiswa_id', $mahasiswa->id)->latest()->first()
            : null;

        return view('mahasiswa.status', compact('pengajuan', 'mahasiswa'));
    }

    // -------------------------------------------------------
    //  PROFIL MAHASISWA
    // -------------------------------------------------------

    /**
     * Tampilkan form edit profil mahasiswa.
     */
    public function editProfil(): View
    {
        $user      = $this->currentUser();
        $mahasiswa = $user->mahasiswa;

        return view('mahasiswa.profil', compact('user', 'mahasiswa'));
    }

    /**
     * Simpan perubahan profil mahasiswa.
     */
    public function updateProfil(UpdateProfilRequest $request): RedirectResponse
    {
        $user = $this->currentUser();

        // Update nama di tabel users
        $user->update(['name' => $request->name]);

        // Update atau buat data mahasiswa
        Mahasiswa::updateOrCreate(
            ['user_id' => $user->id],
            $request->only([
                'nim', 'prodi', 'angkatan', 'no_hp', 'alamat',
                'nama_ayah', 'nama_ibu', 'pekerjaan_ayah', 'pekerjaan_ibu',
                'penghasilan_ortu', 'ipk', 'prestasi', 'keaktifan_org',
            ])
        );

        return redirect()->route('mahasiswa.profil.edit')
            ->with('success', 'Profil berhasil diperbarui.');
    }
}