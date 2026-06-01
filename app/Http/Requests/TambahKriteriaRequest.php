<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TambahKriteriaRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nama'       => ['required', 'string', 'max:100'],
            'kode'       => ['required', 'string', 'max:30', 'unique:kriterias,kode'],
            'bobot'      => ['required', 'numeric', 'min:0', 'max:100'],
            'jenis'      => ['required', 'in:benefit,cost'],
            'keterangan' => ['nullable', 'string'],
        ];
    }
}
