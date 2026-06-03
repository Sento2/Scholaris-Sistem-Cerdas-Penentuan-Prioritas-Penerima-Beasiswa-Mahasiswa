<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class RegisterMahasiswaRequest extends FormRequest
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
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:\App\Models\User,email'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
            'nim' => ['required', 'string', 'max:20', 'unique:mahasiswas,nim'],
            'prodi' => ['required', 'string', 'max:100'],
            'angkatan' => ['required', 'integer', 'min:2015', 'max:'.(date('Y') + 1)],
            'dosen_id' => ['required', 'exists:dosens,id'],
        ];
    }
}
