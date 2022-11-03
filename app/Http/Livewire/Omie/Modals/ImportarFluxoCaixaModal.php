<?php

namespace App\Http\Livewire\Omie\Modals;

use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;

class ImportarFluxoCaixaModal extends ModalComponent
{
    public string $ano = '';

    public function render()
    {
        return view('livewire.omie.modals.importar-fluxo-caixa-modal', [
            'empresas' => Empresa::orderBy('nome')->getModels(),
            'anos' => $this->getAnos()
        ]);
    }

    protected function getAnos(): array
    {
        $anos = [];

        $anoFinal = now()->year;

        for ($ano = 2021; $ano <= $anoFinal; $ano++) {
            $anos[] = $ano;
        }

        return $anos;
    }
}
