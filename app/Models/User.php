<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Konstanta role pengguna
     */
    const ROLE_MAHASISWA = 'mahasiswa';
    const ROLE_DOSEN     = 'dosen';
    const ROLE_ADMIN     = 'admin';

    /**
     * Kolom yang boleh diisi secara massal (mass assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',       // 'mahasiswa' | 'dosen' | 'admin'
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi (misal ke JSON)
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Cast tipe data kolom
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
        ];
    }

    // -------------------------------------------------------
    //  HELPER: cek role secara ekspresif
    // -------------------------------------------------------

    /** Apakah user ini seorang mahasiswa? */
    public function isMahasiswa(): bool
    {
        return $this->role === self::ROLE_MAHASISWA;
    }

    /** Apakah user ini seorang dosen? */
    public function isDosen(): bool
    {
        return $this->role === self::ROLE_DOSEN;
    }

    /** Apakah user ini admin jurusan? */
    public function isAdmin(): bool
    {
        return $this->role === self::ROLE_ADMIN;
    }

    // -------------------------------------------------------
    //  RELASI
    // -------------------------------------------------------

    /**
     * Satu User bisa punya satu data Mahasiswa (profil lengkap)
     */
    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class);
    }

    /**
     * Satu User bisa punya satu data Dosen (profil lengkap)
     */
    public function dosen()
    {
        return $this->hasOne(Dosen::class);
    }

    /**
     * Satu User (dosen) bisa punya banyak mahasiswa bimbingan
     */
    public function mahasiswaBimbingan()
    {
        return $this->hasMany(Mahasiswa::class, 'dosen_id');
    }

    /**
     * Satu User (mahasiswa) bisa punya banyak pengajuan beasiswa
     */
    public function pengajuan()
    {
        return $this->hasManyThrough(
            Pengajuan::class,
            Mahasiswa::class,
            'user_id',       // FK di tabel mahasiswas
            'mahasiswa_id',  // FK di tabel pengajuans
        );
    }
}
