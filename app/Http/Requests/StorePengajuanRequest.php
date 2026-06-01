<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePengajuanRequest extends FormRequest
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
            // Data profil mahasiswa
            'nim'              => ['required', 'string', 'max:20'],
            'prodi'            => ['required', 'string', 'max:100'],
            'angkatan'         => ['required', 'integer', 'min:2000', 'max:2099'],
            'no_hp'            => ['required', 'string', 'max:20'],
            'alamat'           => ['required', 'string'],
            'penghasilan_ortu' => ['required', 'integer', 'min:0'],
            'ipk'              => ['required', 'numeric', 'min:0', 'max:4'],
            'prestasi'         => ['required', 'numeric', 'min:0', 'max:100'],
            'keaktifan_org'    => ['required', 'numeric', 'min:0', 'max:100'],
            // Dokumen wajib
            'dokumen_ktp'      => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'dokumen_kk'       => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'dokumen_sktm'     => ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            'dokumen_transkrip'=> ['required', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
            // Dokumen opsional
            'dokumen_prestasi' => ['nullable', 'file', 'mimes:pdf,jpg,png', 'max:2048'],
        ];
    }
}
