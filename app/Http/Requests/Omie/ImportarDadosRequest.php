<?php

namespace App\Http\Requests\Omie;

use Illuminate\Foundation\Http\FormRequest;

class ImportarDadosRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'ano' => ['required', 'int', 'min:2021', 'max:' . now()->year],
            'mes' => ['required', 'int', 'min:1', 'max:' . now()->startOfYear()->monthsUntil(now())->end->month],
            'file' => ['required', 'file', 'mimes:txt,csv'],
            'empresa' => ['required', 'exists:empresas,id']
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->admin;
    }
}
