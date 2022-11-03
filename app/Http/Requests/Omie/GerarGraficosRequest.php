<?php

namespace App\Http\Requests\Omie;

use Illuminate\Foundation\Http\FormRequest;

class GerarGraficosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'empresa' => ['exists:empresas,id'],
            'ano' => ['int', 'min:2021', 'max:' . now()->year],
        ];
    }

    public function authorize(): bool
    {
        return request()->input('empresa') == auth()->user()->empresa_id || auth()->user()->admin;
    }
}
