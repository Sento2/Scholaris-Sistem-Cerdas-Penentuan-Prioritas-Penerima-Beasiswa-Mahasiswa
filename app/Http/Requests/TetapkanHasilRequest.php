<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TetapkanHasilRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kuota' => ['required', 'integer', 'min:1'],
        ];
    }
}
