<?php

namespace App\Http\Livewire\Empresa\Modals;

use App\Http\Livewire\Empresa\EmpresasTabela;
use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;

class AdicionarEmpresaModal extends ModalComponent
{
    public string $nome = '';
    public string $cnpj = '';

    public function render()
    {
        return view('livewire.empresa.modals.adicionar-empresa-modal');
    }

    protected $rules = [
       'nome' => 'required',
       'cnpj' => 'required|integer|unique:empresas'
    ];

    public function criaEmpresa()
    {
        $this->validate();

        Empresa::create([
            'nome' => $this->nome,
            'cnpj' => $this->cnpj
        ]);

        sweetalert()->addSuccess('Empresa criada com sucesso.', 'Operação Concluída');

        $this->closeModalWithEvents([
            EmpresasTabela::getName() => 'empresaCriada'
        ]);
    }
}
