<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Services\UserService;
use App\Http\Requests\StorePenggunaRequest;
use App\Http\Requests\UpdatePenggunaRequest;
use Illuminate\Http\Request;

class PenggunaController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    /**
     * Menampilkan daftar semua pengguna (Admin, Dosen, Mahasiswa).
     * Mendukung pemfilteran berdasarkan role melalui parameter query 'role'.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = User::with(['dosen', 'mahasiswa.dosen.user'])->latest();

        if ($request->has('role') && $request->role != 'semua') {
            $query->where('role', $request->role);
        }

        $pengguna = $query->paginate(10)->withQueryString();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    /**
     * Menampilkan formulir pendaftaran pengguna baru.
     * Mengirimkan daftar dosen ke view untuk dipilih saat membuat akun Mahasiswa.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $dosens = Dosen::with('user')->get();
        return view('admin.pengguna.form', compact('dosens'));
    }

    /**
     * Menyimpan data pengguna baru beserta profil spesifiknya ke database.
     * Validasi ditangani oleh StorePenggunaRequest.
     * Logika pembuatan profil ditangani oleh UserService.
     *
     * @param StorePenggunaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StorePenggunaRequest $request)
    {
        $this->userService->createUser($request->validated());
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    /**
     * Menampilkan formulir untuk mengedit data pengguna yang sudah ada.
     *
     * @param int $id ID pengguna yang akan diedit
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $pengguna = User::with(['dosen', 'mahasiswa'])->findOrFail($id);
        $dosens = Dosen::with('user')->get();
        return view('admin.pengguna.form', compact('pengguna', 'dosens'));
    }

    /**
     * Memperbarui data pengguna beserta profil spesifiknya di database.
     * Validasi ditangani oleh UpdatePenggunaRequest.
     * Logika pembaruan profil ditangani oleh UserService.
     *
     * @param UpdatePenggunaRequest $request
     * @param int $id ID pengguna
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdatePenggunaRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $this->userService->updateUser($user, $request->validated());
        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    /**
     * Menghapus pengguna secara permanen dari database.
     * Cascading delete pada profil (Dosen/Mahasiswa) ditangani oleh UserService.
     *
     * @param int $id ID pengguna yang akan dihapus
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $this->userService->deleteUser($user);
        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
