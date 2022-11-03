<?php

namespace App\Http\Livewire\Omie\Modals;

use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;

class ImportarDadosModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.omie.modals.importar-dados-modal', [
            'empresas' => Empresa::orderBy('nome')->getModels(),
            'meses' => $this->getMeses(),
            'anos' => $this->getAnos()
        ]);
    }

    protected function getMeses(): array
    {
        $meses = [];

        $monthsPeriod = now()->startOfYear()->monthsUntil(now());
        foreach ($monthsPeriod as $month) {
            $meses[] = [
                'name' => ucfirst($month->monthName),
                'code' => $month->month
            ];
        }

        return $meses;
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
