<?php

namespace App\Http\Livewire\Empresa;

use App\Models\Empresa;
use Livewire\Component;

class EmpresasTabela extends Component
{
    protected $listeners = [
        'empresaCriada' => '$refresh',
        'empresaAtualizada' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.empresa.empresas-tabela', [
            'empresas' => Empresa::orderBy('nome')->getModels()
        ]);
    }
}
