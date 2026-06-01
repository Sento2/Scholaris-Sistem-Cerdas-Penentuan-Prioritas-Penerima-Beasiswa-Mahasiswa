<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProsesVerifikasiRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'keputusan'       => ['required', 'in:setuju,tolak'],
            'catatan_dosen'   => ['nullable', 'string', 'max:500'],
        ];
    }
}
