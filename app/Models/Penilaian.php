<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;

    protected $table = 'penilaians';

    /**
     * Kolom yang boleh diisi secara massal.
     * Tabel ini menyimpan hasil perhitungan SAW per baris (per kriteria per pengajuan).
     */
    protected $fillable = [
        'pengajuan_id',
        'kriteria_id',
        'nilai_asli',    // nilai mentah (misal IPK: 3.72, penghasilan: 2000000)
        'nilai_normal',  // hasil normalisasi (0–1)
        'nilai_bobot',   // nilai_normal * (bobot/100)
    ];

    /**
     * Cast tipe data
     */
    protected $casts = [
        'nilai_asli'   => 'float',
        'nilai_normal' => 'float',
        'nilai_bobot'  => 'float',
    ];

    // -------------------------------------------------------
    //  RELASI
    // -------------------------------------------------------

    /**
     * Penilaian ini milik satu Pengajuan
     */
    public function pengajuan()
    {
        return $this->belongsTo(Pengajuan::class);
    }

    /**
     * Penilaian ini menggunakan satu Kriteria
     */
    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class);
    }
}