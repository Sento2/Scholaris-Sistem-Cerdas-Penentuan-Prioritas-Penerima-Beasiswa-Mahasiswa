<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SimpanBobotRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kriteria'          => ['required', 'array'],
            'kriteria.*.id'     => ['required', 'exists:kriterias,id'],
            'kriteria.*.bobot'  => ['required', 'numeric', 'min:0', 'max:100'],
            'kriteria.*.jenis'  => ['required', 'in:benefit,cost'],
        ];
    }

    public function withValidator($validator)
    {
        $validator->after(function ($validator) {
            $totalBobot = collect($this->kriteria)->sum('bobot');
            if (abs($totalBobot - 100) > 0.01) {
                $validator->errors()->add('bobot', "Total bobot harus 100%. Jumlah saat ini: {$totalBobot}%.");
            }
        });
    }
}
