<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;

    protected $table = 'pengajuans';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'mahasiswa_id',
        'status',           // 'menunggu' | 'diverifikasi' | 'dihitung' | 'diterima' | 'ditolak'
        'catatan_dosen',    // catatan/rekomendasi dari dosen pembimbing
        'catatan_admin',    // catatan dari admin jurusan
        'skor_saw',         // hasil akhir skor SAW (decimal 0–1)
        'rank',             // posisi ranking setelah SAW dihitung
        'dokumen_ktp',      // path file KTP
        'dokumen_kk',       // path file Kartu Keluarga
        'dokumen_sktm',     // path file Surat Keterangan Tidak Mampu
        'dokumen_transkrip',// path file transkrip nilai
        'dokumen_prestasi', // path file bukti prestasi (opsional)
        'diverifikasi_at',  // timestamp saat dosen verifikasi
        'dihitung_at',      // timestamp saat SAW dihitung
        'diputuskan_at',    // timestamp saat admin membuat keputusan final
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'skor_saw'         => 'float',
        'rank'             => 'integer',
        'diverifikasi_at'  => 'datetime',
        'dihitung_at'      => 'datetime',
        'diputuskan_at'    => 'datetime',
    ];

    // -------------------------------------------------------
    //  KONSTANTA STATUS
    // -------------------------------------------------------
    const STATUS_MENUNGGU    = 'menunggu';
    const STATUS_DIVERIFIKASI = 'diverifikasi';
    const STATUS_DIHITUNG    = 'dihitung';
    const STATUS_DITERIMA    = 'diterima';
    const STATUS_DITOLAK     = 'ditolak';

    // -------------------------------------------------------
    //  RELASI
    // -------------------------------------------------------

    /**
     * Pengajuan dimiliki oleh satu Mahasiswa
     */
    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class);
    }

    /**
     * Pengajuan memiliki banyak baris Penilaian (hasil per kriteria SAW)
     */
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    // -------------------------------------------------------
    //  SCOPE: filter berdasarkan status
    // -------------------------------------------------------
    public function scopeMenunggu($query)
    {
        return $query->where('status', self::STATUS_MENUNGGU);
    }

    public function scopeSudahDiverifikasi($query)
    {
        return $query->where('status', self::STATUS_DIVERIFIKASI);
    }

    public function scopeSudahDihitung($query)
    {
        return $query->whereNotNull('skor_saw')->orderBy('rank');
    }

    // -------------------------------------------------------
    //  ACCESSOR: label status (untuk tampilan badge)
    // -------------------------------------------------------
    public function getLabelStatusAttribute(): string
    {
        return match($this->status) {
            self::STATUS_MENUNGGU     => 'Menunggu Verifikasi',
            self::STATUS_DIVERIFIKASI => 'Sedang Diverifikasi',
            self::STATUS_DIHITUNG     => 'Sudah Dihitung',
            self::STATUS_DITERIMA     => 'Diterima',
            self::STATUS_DITOLAK      => 'Tidak Lolos',
            default                   => 'Unknown',
        };
    }

    /**
     * Warna badge Bootstrap/Tailwind berdasarkan status
     */
    public function getWarnaBadgeAttribute(): string
    {
        return match($this->status) {
            self::STATUS_MENUNGGU     => 'warning',
            self::STATUS_DIVERIFIKASI => 'info',
            self::STATUS_DIHITUNG     => 'primary',
            self::STATUS_DITERIMA     => 'success',
            self::STATUS_DITOLAK      => 'danger',
            default                   => 'secondary',
        };
    }
}