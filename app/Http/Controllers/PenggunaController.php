<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PenggunaController extends Controller
{
    public function index(Request $request)
    {
        $query = User::with(['dosen', 'mahasiswa.dosen.user'])->latest();

        if ($request->has('role') && $request->role != 'semua') {
            $query->where('role', $request->role);
        }

        $pengguna = $query->paginate(10)->withQueryString();
        return view('admin.pengguna.index', compact('pengguna'));
    }

    public function create()
    {
        $dosens = Dosen::with('user')->get();
        return view('admin.pengguna.form', compact('dosens'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,dosen,mahasiswa',
            // Dosen
            'nip' => 'required_if:role,dosen|nullable|string|max:20|unique:dosens,nip',
            // Mahasiswa
            'nim' => 'required_if:role,mahasiswa|nullable|string|max:20|unique:mahasiswas,nim',
            'prodi' => 'required_if:role,mahasiswa|nullable|string|max:100',
            'angkatan' => 'required_if:role,mahasiswa|nullable|integer',
            'dosen_id' => 'required_if:role,mahasiswa|nullable|exists:dosens,id',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        if ($request->role === 'dosen') {
            Dosen::create([
                'user_id' => $user->id,
                'nip' => $request->nip,
                'prodi' => $request->prodi_dosen ?? 'Tidak Ditentukan',
            ]);
        } elseif ($request->role === 'mahasiswa') {
            Mahasiswa::create([
                'user_id' => $user->id,
                'dosen_id' => $request->dosen_id,
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
            ]);
        }

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pengguna = User::with(['dosen', 'mahasiswa'])->findOrFail($id);
        $dosens = Dosen::with('user')->get();
        return view('admin.pengguna.form', compact('pengguna', 'dosens'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'password' => 'nullable|string|min:8',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->password) {
            $user->password = Hash::make($request->password);
        }
        $user->save();

        if ($user->role === 'dosen' && $user->dosen) {
            $request->validate(['nip' => ['required', 'string', 'max:20', Rule::unique('dosens')->ignore($user->dosen->id)]]);
            $user->dosen->update(['nip' => $request->nip]);
        } elseif ($user->role === 'mahasiswa' && $user->mahasiswa) {
            $request->validate([
                'nim' => ['required', 'string', 'max:20', Rule::unique('mahasiswas')->ignore($user->mahasiswa->id)],
                'prodi' => 'required|string|max:100',
                'angkatan' => 'required|integer',
                'dosen_id' => 'required|exists:dosens,id',
            ]);
            $user->mahasiswa->update([
                'nim' => $request->nim,
                'prodi' => $request->prodi,
                'angkatan' => $request->angkatan,
                'dosen_id' => $request->dosen_id,
            ]);
        }

        return redirect()->route('admin.pengguna.index')->with('success', 'Data pengguna berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        // The cascading delete should be handled by DB, but if not we can delete related records
        if ($user->role === 'dosen' && $user->dosen) {
            $user->dosen->delete();
        } elseif ($user->role === 'mahasiswa' && $user->mahasiswa) {
            $user->mahasiswa->delete();
        }
        $user->delete();

        return redirect()->route('admin.pengguna.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
