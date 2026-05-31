<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $table = 'kriterias';

    /**
     * Kolom yang boleh diisi secara massal
     */
    protected $fillable = [
        'nama',     // Nama kriteria, misal: "IPK", "Penghasilan Orang Tua"
        'bobot',    // Bobot dalam persen, misal: 35 (untuk 35%)
        'jenis',    // 'benefit' (semakin tinggi semakin baik) atau 'cost' (semakin rendah semakin baik)
        'kode',     // Kode singkat: 'ipk', 'penghasilan', 'prestasi', 'keaktifan'
        'keterangan',
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'bobot' => 'float',
    ];

    // -------------------------------------------------------
    //  KONSTANTA jenis kriteria
    // -------------------------------------------------------
    const JENIS_BENEFIT = 'benefit'; // semakin tinggi nilainya = semakin baik
    const JENIS_COST    = 'cost';    // semakin rendah nilainya = semakin baik

    // -------------------------------------------------------
    //  RELASI
    // -------------------------------------------------------

    /**
     * Satu kriteria digunakan di banyak baris Penilaian
     */
    public function penilaian()
    {
        return $this->hasMany(Penilaian::class);
    }

    // -------------------------------------------------------
    //  SCOPE: ambil semua kriteria yang aktif, urut bobot
    // -------------------------------------------------------
    public function scopeAktif($query)
    {
        return $query->orderBy('bobot', 'desc');
    }

    // -------------------------------------------------------
    //  HELPER: total bobot semua kriteria (harus = 100)
    // -------------------------------------------------------
    public static function totalBobot(): float
    {
        return self::sum('bobot');
    }
}