<?php

namespace App\Http\Livewire\Omie\Modals;

use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;

class GerarGraficosModal extends ModalComponent
{
    public string $ano = '';
    public string $empresa = '';

    public function render()
    {
        $empresaQuery = Empresa::orderBy('nome');

        if (!auth()->user()->admin) {
            $empresaQuery = $empresaQuery->whereId(auth()->user()->empresa_id);
        }

        return view('livewire.omie.modals.gerar-graficos-modal', [
            'empresas' => $empresaQuery->getModels(),
            'anos' => $this->getAnos()
        ]);
    }

    protected function getAnos(): array
    {
        $anos = [];

        $anoFinal = now()->year;

        for ($ano = 2015; $ano <= $anoFinal; $ano++) {
            $anos[] = $ano;
        }

        return $anos;
    }
}
