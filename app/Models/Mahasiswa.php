<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswas';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'user_id',
        'dosen_id',     // FK ke tabel users (dosen pembimbing)
        'nim',
        'prodi',
        'angkatan',
        'no_hp',
        'alamat',
        'nama_ayah',
        'nama_ibu',
        'pekerjaan_ayah',
        'pekerjaan_ibu',
        'penghasilan_ortu',  // nominal per bulan (integer)
        'ipk',               // decimal(3,2)
        'prestasi',          // 0-100: skor prestasi akademik/non-akademik
        'keaktifan_org',     // 0-100: skor keaktifan organisasi
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'ipk'            => 'float',
        'penghasilan_ortu' => 'integer',
        'prestasi'       => 'float',
        'keaktifan_org'  => 'float',
        'angkatan'       => 'integer',
    ];

    // -------------------------------------------------------
    //  RELASI
    // -------------------------------------------------------

    /**
     * Mahasiswa dimiliki oleh satu User (akun login)
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mahasiswa dibimbing oleh satu Dosen (User dengan role dosen)
     */
    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'dosen_id');
    }

    /**
     * Mahasiswa bisa punya banyak Pengajuan beasiswa
     */
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }

    /**
     * Pengajuan terbaru/aktif milik mahasiswa ini
     */
    public function pengajuanAktif()
    {
        return $this->hasOne(Pengajuan::class)->latest();
    }

    // -------------------------------------------------------
    //  ACCESSOR: label penghasilan (untuk tampilan)
    // -------------------------------------------------------
    public function getLabelPenghasilanAttribute(): string
    {
        $p = $this->penghasilan_ortu;
        if ($p < 1_000_000)  return 'Di bawah Rp 1 juta';
        if ($p < 2_500_000)  return 'Rp 1 – 2,5 juta';
        if ($p < 5_000_000)  return 'Rp 2,5 – 5 juta';
        return 'Di atas Rp 5 juta';
    }
}