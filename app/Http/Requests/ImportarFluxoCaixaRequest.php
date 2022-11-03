<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ImportarFluxoCaixaRequest extends FormRequest
{
    public function rules(): array
    {
        return [
//            'ano' => ['required', 'int', 'min:2015', 'max:' . now()->year],
            'file' => ['required', 'file', 'mimes:pdf'],
            'empresa' => ['required', 'exists:empresas,id']
        ];
    }

    public function authorize(): bool
    {
        return auth()->user()->admin;
    }
}
