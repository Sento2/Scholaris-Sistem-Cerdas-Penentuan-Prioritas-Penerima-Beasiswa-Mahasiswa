<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StorePenggunaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
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
        ];
    }
}
