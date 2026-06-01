<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beasiswa extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'kuota',
        'deadline',
        'status',
    ];

    protected $casts = [
        'deadline' => 'date',
    ];

    /**
     * Beasiswa bisa memiliki banyak Pengajuan.
     */
    public function pengajuan()
    {
        return $this->hasMany(Pengajuan::class);
    }
}
