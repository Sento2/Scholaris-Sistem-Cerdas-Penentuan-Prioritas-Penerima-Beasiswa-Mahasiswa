<?php

namespace App\Services;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UserService
{
    /**
     * Membuat pengguna baru beserta profil spesifiknya (Dosen/Mahasiswa).
     * Dibungkus dalam DB Transaction agar mencegah data parsial jika terjadi kegagalan.
     *
     * @param array $data Data pengguna dan profil yang sudah tervalidasi
     * @return User Object User yang baru saja dibuat
     */
    public function createUser(array $data): User
    {
        return DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            if ($data['role'] === 'dosen') {
                Dosen::create([
                    'user_id' => $user->id,
                    'nip' => $data['nip'] ?? null,
                    'prodi' => $data['prodi_dosen'] ?? 'Tidak Ditentukan',
                ]);
            } elseif ($data['role'] === 'mahasiswa') {
                Mahasiswa::create([
                    'user_id' => $user->id,
                    'dosen_id' => $data['dosen_id'] ?? null,
                    'nim' => $data['nim'] ?? null,
                    'prodi' => $data['prodi'] ?? null,
                    'angkatan' => $data['angkatan'] ?? null,
                ]);
            }

            return $user;
        });
    }

    /**
     * Memperbarui data pengguna beserta profil spesifiknya secara atomik.
     * Kata sandi hanya akan di-hash dan diubah jika array $data['password'] tidak kosong.
     *
     * @param User $user Object User yang akan diedit
     * @param array $data Data terbaru yang sudah tervalidasi
     * @return User Object User yang sudah diperbarui
     */
    public function updateUser(User $user, array $data): User
    {
        return DB::transaction(function () use ($user, $data) {
            $user->name = $data['name'];
            $user->email = $data['email'];
            
            if (!empty($data['password'])) {
                $user->password = Hash::make($data['password']);
            }
            
            $user->save();

            if ($user->role === 'dosen' && $user->dosen) {
                $user->dosen->update([
                    'nip' => $data['nip'] ?? $user->dosen->nip
                ]);
            } elseif ($user->role === 'mahasiswa' && $user->mahasiswa) {
                $user->mahasiswa->update([
                    'nim' => $data['nim'] ?? $user->mahasiswa->nim,
                    'prodi' => $data['prodi'] ?? $user->mahasiswa->prodi,
                    'angkatan' => $data['angkatan'] ?? $user->mahasiswa->angkatan,
                    'dosen_id' => $data['dosen_id'] ?? $user->mahasiswa->dosen_id,
                ]);
            }

            return $user;
        });
    }

    /**
     * Menghapus pengguna dan profil terkait dari database secara permanen.
     * Jika relasi foreign key belum diset ke CASCADE, fungsi ini memastikan
     * tabel anak (dosen/mahasiswa) ikut terhapus.
     *
     * @param User $user Object user yang akan dihapus
     * @return void
     */
    public function deleteUser(User $user): void
    {
        DB::transaction(function () use ($user) {
            if ($user->role === 'dosen' && $user->dosen) {
                $user->dosen->delete();
            } elseif ($user->role === 'mahasiswa' && $user->mahasiswa) {
                $user->mahasiswa->delete();
            }
            $user->delete();
        });
    }
}
