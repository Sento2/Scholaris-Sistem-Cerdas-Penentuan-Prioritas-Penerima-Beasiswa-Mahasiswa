<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePenggunaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('pengguna');
        $user = \App\Models\User::find($userId);

        $rules = [
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255', \Illuminate\Validation\Rule::unique('users')->ignore($userId)],
            'password' => 'nullable|string|min:8',
        ];

        if ($user && $user->role === 'dosen' && $user->dosen) {
            $rules['nip'] = ['required', 'string', 'max:20', \Illuminate\Validation\Rule::unique('dosens')->ignore($user->dosen->id)];
        } elseif ($user && $user->role === 'mahasiswa' && $user->mahasiswa) {
            $rules['nim'] = ['required', 'string', 'max:20', \Illuminate\Validation\Rule::unique('mahasiswas')->ignore($user->mahasiswa->id)];
            $rules['prodi'] = 'required|string|max:100';
            $rules['angkatan'] = 'required|integer';
            $rules['dosen_id'] = 'required|exists:dosens,id';
        }

        return $rules;
    }
}
