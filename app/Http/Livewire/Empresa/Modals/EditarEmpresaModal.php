<?php

namespace App\Http\Livewire\Empresa\Modals;

use App\Http\Livewire\Empresa\EmpresasTabela;
use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;

class EditarEmpresaModal extends ModalComponent
{
    public Empresa $empresa;

    protected $rules = [
        'empresa.nome' => 'required',
        'empresa.cnpj' => 'required|integer'
    ];

    public function mount(Empresa $empresa)
    {
        $this->empresa = $empresa;
    }

    public function render()
    {
        return view('livewire.empresa.modals.editar-empresa-modal');
    }

    public function salvarEmpresa()
    {
        $this->validate();

        $this->empresa->save();

        sweetalert()->addSuccess('Empresa atualizada.', 'Operação Concluída');

        $this->closeModalWithEvents([
            EmpresasTabela::getName() => 'empresaAtualizada'
        ]);
    }
}
