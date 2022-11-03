<?php

namespace App\Http\Livewire\Omie\Modals;

use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;

class ImportarFluxoCaixaModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.omie.modals.importar-fluxo-caixa-modal', [
            'empresas' => Empresa::orderBy('nome')->getModels(),
        ]);
    }
}
