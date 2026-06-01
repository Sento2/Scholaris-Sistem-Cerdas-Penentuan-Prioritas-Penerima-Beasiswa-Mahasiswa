<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProfilRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'             => ['required', 'string', 'max:255'],
            'nim'              => ['required', 'string', 'max:20'],
            'prodi'            => ['required', 'string', 'max:100'],
            'angkatan'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'no_hp'            => ['nullable', 'string', 'max:20'],
            'alamat'           => ['nullable', 'string', 'max:500'],
            'nama_ayah'        => ['nullable', 'string', 'max:100'],
            'nama_ibu'         => ['nullable', 'string', 'max:100'],
            'pekerjaan_ayah'   => ['nullable', 'string', 'max:100'],
            'pekerjaan_ibu'    => ['nullable', 'string', 'max:100'],
            'penghasilan_ortu' => ['nullable', 'integer', 'min:0'],
            'ipk'              => ['nullable', 'numeric', 'min:0', 'max:4'],
            'prestasi'         => ['nullable', 'numeric', 'min:0', 'max:100'],
            'keaktifan_org'    => ['nullable', 'numeric', 'min:0', 'max:100'],
        ];
    }
}
