<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\User;
use App\services\SAWService;
use App\Exports\PenerimaBeasiswaExport;
use App\Http\Requests\SimpanBobotRequest;
use App\Http\Requests\TambahKriteriaRequest;
use App\Http\Requests\TetapkanHasilRequest;
use App\Notifications\StatusPengajuanNotification;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function __construct(protected SAWService $sawService) {}

    // -------------------------------------------------------
    //  DASHBOARD ADMIN
    // -------------------------------------------------------

    /**
     * Dashboard utama admin jurusan.
     * Menampilkan statistik pendaftar, ranking terbaru, dan aktivitas.
     */
    public function dashboard(): View
    {
        $stats = [
            'total_pendaftar'  => Pengajuan::count(),
            'menunggu_verif'   => Pengajuan::where('status', Pengajuan::STATUS_MENUNGGU)->count(),
            'sudah_verif'      => Pengajuan::where('status', Pengajuan::STATUS_DIVERIFIKASI)->count(),
            'sudah_dihitung'   => Pengajuan::where('status', Pengajuan::STATUS_DIHITUNG)->count(),
            'diterima'         => Pengajuan::where('status', Pengajuan::STATUS_DITERIMA)->count(),
            'total_mahasiswa'  => User::where('role', User::ROLE_MAHASISWA)->count(),
            'total_dosen'      => User::where('role', User::ROLE_DOSEN)->count(),
        ];

        // Top 5 ranking untuk preview di dashboard
        $topRanking = Pengajuan::with('mahasiswa.user')
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->limit(5)
            ->get();

        // Aktivitas terbaru
        $aktivitasTerbaru = Pengajuan::with('mahasiswa.user')
            ->latest()
            ->limit(8)
            ->get();

        return view('admin.dashboard', compact('stats', 'topRanking', 'aktivitasTerbaru'));
    }

    // -------------------------------------------------------
    //  RANKING SAW
    // -------------------------------------------------------

    /**
     * Tampilkan halaman ranking hasil SAW.
     */
    public function ranking(): View
    {
        $rankingList  = $this->sawService->getRanking();
        $kriteriaList = Kriteria::orderBy('bobot', 'desc')->get();
        $totalBobot   = Kriteria::totalBobot();

        return view('admin.ranking', compact('rankingList', 'kriteriaList', 'totalBobot'));
    }

    /**
     * Jalankan perhitungan SAW dan simpan hasilnya.
     * Dipanggil saat admin klik tombol "Hitung Ranking SAW".
     */
    public function hitungSAW(): RedirectResponse
    {
        // Cek apakah ada pengajuan terverifikasi yang belum dihitung
        $belumDihitung = Pengajuan::where('status', Pengajuan::STATUS_DIVERIFIKASI)->count();

        if ($belumDihitung === 0) {
            return redirect()->route('admin.ranking')
                ->with('info', 'Tidak ada pengajuan baru yang perlu dihitung.');
        }

        // Cek apakah total bobot sudah 100%
        $totalBobot = Kriteria::totalBobot();
        if (abs($totalBobot - 100) > 0.01) {
            return redirect()->route('admin.bobot')
                ->with('error', "Total bobot kriteria harus 100%. Saat ini: {$totalBobot}%. Silakan perbaiki dulu.");
        }

        // Jalankan SAW
        $hasil = $this->sawService->hitung();

        return redirect()->route('admin.ranking')
            ->with('success', "Perhitungan SAW selesai. {$hasil->count()} kandidat telah diranking.");
    }

    /**
     * Tetapkan keputusan final (terima/tolak) berdasarkan ranking dan kuota.
     */
    public function tetapkanHasil(TetapkanHasilRequest $request): RedirectResponse
    {

        $kuota = (int) $request->kuota;

        // Ambil semua yang sudah dihitung, urutkan rank
        $semuaPengajuan = Pengajuan::with('mahasiswa.user')
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->get();

        foreach ($semuaPengajuan as $idx => $pengajuan) {
            $isDiterima = $idx < $kuota;
            $statusBaru = $isDiterima ? Pengajuan::STATUS_DITERIMA : Pengajuan::STATUS_DITOLAK;

            $pengajuan->update([
                'status'         => $statusBaru,
                'diputuskan_at'  => now(),
            ]);

            $jenisNotif = $isDiterima ? 'success' : 'danger';
            $pesanNotif = $isDiterima
                ? 'Selamat! Pengajuan Beasiswa Anda telah DITERIMA.'
                : 'Mohon Maaf, Pengajuan Beasiswa Anda DITOLAK (Batas Kuota / Peringkat).';
                
            $pengajuan->mahasiswa->user->notify(new StatusPengajuanNotification($statusBaru, $pesanNotif, $jenisNotif));
        }

        return redirect()->route('admin.ranking')
            ->with('success', "Keputusan final ditetapkan. {$kuota} mahasiswa diterima sebagai penerima beasiswa.");
    }

    // -------------------------------------------------------
    //  KELOLA BOBOT KRITERIA SAW
    // -------------------------------------------------------

    /**
     * Tampilkan halaman pengaturan bobot kriteria.
     */
    public function bobot(): View
    {
        $kriteriaList = Kriteria::orderBy('bobot', 'desc')->get();
        $totalBobot   = Kriteria::totalBobot();

        return view('admin.bobot', compact('kriteriaList', 'totalBobot'));
    }

    /**
     * Simpan perubahan bobot kriteria.
     */
    public function simpanBobot(SimpanBobotRequest $request): RedirectResponse
    {

        // Simpan tiap kriteria
        foreach ($request->kriteria as $item) {
            Kriteria::where('id', $item['id'])->update([
                'bobot' => $item['bobot'],
                'jenis' => $item['jenis'],
            ]);
        }

        return redirect()->route('admin.bobot')
            ->with('success', 'Bobot kriteria berhasil disimpan. Silakan hitung ulang ranking SAW.');
    }

    /**
     * Tambah kriteria baru.
     */
    public function tambahKriteria(TambahKriteriaRequest $request): RedirectResponse
    {

        Kriteria::create($request->only('nama', 'kode', 'bobot', 'jenis', 'keterangan'));

        return redirect()->route('admin.bobot')
            ->with('success', 'Kriteria baru berhasil ditambahkan.');
    }

    /**
     * Hapus kriteria.
     */
    public function hapusKriteria(int $id): RedirectResponse
    {
        Kriteria::findOrFail($id)->delete();

        return redirect()->route('admin.bobot')
            ->with('success', 'Kriteria berhasil dihapus.');
    }

    // -------------------------------------------------------
    //  DATA SEMUA PENDAFTAR
    // -------------------------------------------------------

    /**
     * Tampilkan semua data pengajuan (untuk tabel admin).
     */
    public function data(Request $request): View
    {
        $query = Pengajuan::with('mahasiswa.user');

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan nama/NIM
        if ($request->filled('cari')) {
            $cari = $request->cari;
            $query->whereHas('mahasiswa', fn($q) =>
                $q->where('nim', 'like', "%{$cari}%")
                  ->orWhereHas('user', fn($q2) =>
                      $q2->where('name', 'like', "%{$cari}%"))
            );
        }

        $pengajuanList = $query->latest()->paginate(15);

        $statusList = [
            Pengajuan::STATUS_MENUNGGU,
            Pengajuan::STATUS_DIVERIFIKASI,
            Pengajuan::STATUS_DIHITUNG,
            Pengajuan::STATUS_DITERIMA,
            Pengajuan::STATUS_DITOLAK,
        ];

        return view('admin.data', compact('pengajuanList', 'statusList'));
    }

    // -------------------------------------------------------
    //  LAPORAN DISTRIBUSI
    // -------------------------------------------------------

    /**
     * Tampilkan halaman laporan distribusi penerima beasiswa.
     */
    public function laporan(): View
    {
        // Distribusi per prodi
        $perProdi = Mahasiswa::select('prodi')
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('SUM(CASE WHEN (SELECT status FROM pengajuans WHERE mahasiswa_id = mahasiswas.id ORDER BY created_at DESC LIMIT 1) = ? THEN 1 ELSE 0 END) as diterima', [Pengajuan::STATUS_DITERIMA])
            ->groupBy('prodi')
            ->get();

        // Distribusi per angkatan
        $perAngkatan = Mahasiswa::select('angkatan')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('angkatan')
            ->orderBy('angkatan')
            ->get();

        // Total statistik keseluruhan
        $totalStats = [
            'total_pendaftar' => Pengajuan::count(),
            'total_diterima'  => Pengajuan::where('status', Pengajuan::STATUS_DITERIMA)->count(),
            'total_ditolak'   => Pengajuan::where('status', Pengajuan::STATUS_DITOLAK)->count(),
            'rata_skor'       => round(Pengajuan::whereNotNull('skor_saw')->avg('skor_saw'), 3),
        ];

        // Data lengkap penerima (untuk tabel ekspor)
        $penerima = Pengajuan::with('mahasiswa.user')
            ->where('status', Pengajuan::STATUS_DITERIMA)
            ->orderBy('rank')
            ->get();

        return view('admin.laporan', compact(
            'perProdi', 'perAngkatan', 'totalStats', 'penerima'
        ));
    }

    /**
     * Export laporan penerima beasiswa ke format PDF.
     */
    public function exportPdf()
    {
        $penerima = Pengajuan::with('mahasiswa.user')
            ->where('status', Pengajuan::STATUS_DITERIMA)
            ->orderBy('rank')
            ->get();

        $pdf = Pdf::loadView('admin.exports.laporan-pdf', compact('penerima'));
        return $pdf->download('laporan-penerima-beasiswa.pdf');
    }

    /**
     * Export laporan penerima beasiswa ke format Excel.
     */
    public function exportExcel()
    {
        return Excel::download(new PenerimaBeasiswaExport, 'laporan-penerima-beasiswa.xlsx');
    }
}