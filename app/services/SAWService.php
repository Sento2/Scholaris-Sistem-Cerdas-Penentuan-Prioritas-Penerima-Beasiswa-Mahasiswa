<?php

namespace App\services;

use App\Models\Kriteria;
use App\Models\Mahasiswa;
use App\Models\Pengajuan;
use App\Models\Penilaian;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

/**
 * SAWService
 * ------------------------------------------------------------------
 * Kelas ini mengimplementasikan algoritma Simple Additive Weighting
 * (SAW) untuk menentukan ranking penerima beasiswa.
 *
 * ALUR ALGORITMA:
 *  1. Ambil semua pengajuan yang sudah diverifikasi
 *  2. Ambil semua kriteria beserta bobotnya
 *  3. Buat matriks keputusan (nilai tiap kandidat per kriteria)
 *  4. Normalisasi matriks (benefit: ri = xi / max(x), cost: ri = min(x) / xi)
 *  5. Hitung skor akhir: Vi = Σ (wj * rij)
 *  6. Urutkan dari skor tertinggi → simpan ke database
 * ------------------------------------------------------------------
 */
class SAWService
{
    /**
     * Jalankan perhitungan SAW untuk semua pengajuan yang sudah diverifikasi.
     * Hasil ranking & skor disimpan ke tabel pengajuans dan penilaians.
     *
     * @return Collection  Koleksi pengajuan yang sudah diberi skor & rank
     */
    public function hitung(): Collection
    {
        // 1. Ambil semua pengajuan berstatus 'diverifikasi'
        $pengajuanList = Pengajuan::with('mahasiswa')
            ->where('status', Pengajuan::STATUS_DIVERIFIKASI)
            ->get();

        if ($pengajuanList->isEmpty()) {
            return collect();
        }

        // 2. Ambil semua kriteria
        $kriteriaList = Kriteria::all();

        if ($kriteriaList->isEmpty()) {
            return collect();
        }

        // 3. Buat matriks nilai asli: [ pengajuan_id => [ kriteria_kode => nilai ] ]
        $matriks = [];
        foreach ($pengajuanList as $pengajuan) {
            $mhs = $pengajuan->mahasiswa;
            foreach ($kriteriaList as $k) {
                // Petakan kode kriteria ke kolom yang ada di model Mahasiswa
                $matriks[$pengajuan->id][$k->id] = $this->ambilNilai($mhs, $k->kode);
            }
        }

        // 4. Normalisasi matriks
        $matriksNormal = $this->normalisasi($matriks, $kriteriaList);

        // 5. Hitung skor akhir setiap kandidat
        $skorAkhir = [];
        foreach ($pengajuanList as $pengajuan) {
            $total = 0;
            foreach ($kriteriaList as $k) {
                $nilaiNormal = $matriksNormal[$pengajuan->id][$k->id] ?? 0;
                $total += ($k->bobot / 100) * $nilaiNormal;
            }
            $skorAkhir[$pengajuan->id] = round($total, 4);
        }

        // 6. Urutkan dari skor tertinggi
        arsort($skorAkhir);

        // 7. Simpan hasil ke database (dalam satu transaksi)
        DB::transaction(function () use ($pengajuanList, $kriteriaList, $matriks, $matriksNormal, $skorAkhir) {
            $rank = 1;
            foreach ($skorAkhir as $pengajuanId => $skor) {
                $pengajuan = $pengajuanList->find($pengajuanId);

                // Update skor & rank di tabel pengajuans
                $pengajuan->update([
                    'skor_saw'    => $skor,
                    'rank'        => $rank,
                    'status'      => Pengajuan::STATUS_DIHITUNG,
                    'dihitung_at' => now(),
                ]);

                // Simpan detail penilaian per kriteria (hapus dulu jika sudah ada)
                Penilaian::where('pengajuan_id', $pengajuanId)->delete();

                foreach ($kriteriaList as $k) {
                    $nilaiAsli   = $matriks[$pengajuanId][$k->id]       ?? 0;
                    $nilaiNormal = $matriksNormal[$pengajuanId][$k->id] ?? 0;
                    $nilaiBobot  = round(($k->bobot / 100) * $nilaiNormal, 4);

                    Penilaian::create([
                        'pengajuan_id' => $pengajuanId,
                        'kriteria_id'  => $k->id,
                        'nilai_asli'   => $nilaiAsli,
                        'nilai_normal' => round($nilaiNormal, 4),
                        'nilai_bobot'  => $nilaiBobot,
                    ]);
                }

                $rank++;
            }
        });

        // Kembalikan data pengajuan yang sudah diperbarui, urut rank
        return Pengajuan::with(['mahasiswa.user', 'penilaian.kriteria'])
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->get();
    }

    /**
     * Ambil nilai mentah mahasiswa berdasarkan kode kriteria.
     * Kode harus sesuai dengan kolom di tabel mahasiswas.
     */
    private function ambilNilai(Mahasiswa $mhs, string $kode): float
    {
        return match($kode) {
            'ipk'          => (float) $mhs->ipk,
            'penghasilan'  => (float) $mhs->penghasilan_ortu,
            'prestasi'     => (float) $mhs->prestasi,
            'keaktifan'    => (float) $mhs->keaktifan_org,
            default        => 0.0,
        };
    }

    /**
     * Normalisasi matriks keputusan.
     *
     * - BENEFIT : rij = xij / max(xj)   → semakin tinggi semakin baik (IPK, prestasi)
     * - COST    : rij = min(xj) / xij   → semakin rendah semakin baik (penghasilan ortu)
     *
     * @param  array      $matriks       [ pengajuan_id => [ kriteria_id => nilai ] ]
     * @param  Collection $kriteriaList
     * @return array      $matriksNormal [ pengajuan_id => [ kriteria_id => nilai_normal ] ]
     */
    private function normalisasi(array $matriks, Collection $kriteriaList): array
    {
        $normal = [];

        foreach ($kriteriaList as $k) {
            // Kumpulkan semua nilai kolom ini
            $nilaiKolom = array_column(
                array_map(fn($row) => [$k->id => $row[$k->id] ?? 0], $matriks),
                $k->id
            );
            // Ambil max & min
            $maxVal = max($nilaiKolom) ?: 1; // hindari pembagian nol
            $minVal = min($nilaiKolom) ?: 1;

            foreach ($matriks as $pengajuanId => $row) {
                $nilai = $row[$k->id] ?? 0;

                if ($k->jenis === Kriteria::JENIS_BENEFIT) {
                    $normal[$pengajuanId][$k->id] = $maxVal > 0
                        ? $nilai / $maxVal
                        : 0;
                } else {
                    // COST
                    $normal[$pengajuanId][$k->id] = $nilai > 0
                        ? $minVal / $nilai
                        : 0;
                }
            }
        }

        return $normal;
    }

    /**
     * Ambil hasil ranking terbaru dari database (tanpa menghitung ulang).
     */
    public function getRanking(): Collection
    {
        return Pengajuan::with(['mahasiswa.user', 'penilaian.kriteria'])
            ->whereNotNull('rank')
            ->orderBy('rank')
            ->get();
    }

    /**
     * Ambil detail skor SAW untuk satu pengajuan (untuk halaman mahasiswa).
     */
    public function getDetailSkor(int $pengajuanId): ?Pengajuan
    {
        return Pengajuan::with(['penilaian.kriteria', 'mahasiswa.user'])
            ->find($pengajuanId);
    }
}