<?php

namespace App\Http\Livewire\Omie\Modals;

use App\Models\Empresa;
use LivewireUI\Modal\ModalComponent;
use Storage;

class DownloadFluxoModal extends ModalComponent
{
    public string $ano = '';
    public string $empresa = '';

    public function render()
    {
        return view('livewire.omie.modals.download-fluxo-modal',
            [
                'anos' => $this->getAnos(),
                'empresas' => auth()->user()->admin ? Empresa::orderBy('nome')->getModels() : [auth()->user()->empresa],
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

    public function download()
    {
        $empresa = Empresa::find($this->empresa);

        if (!$empresa->hasFluxoCaixa($this->ano)) {
            sweetalert()->addInfo('Não existe fluxo de caixa para este ano.', 'Alerta');
            return false;
        }

        if (!auth()->user()->admin && auth()->user()->empresa_id != $empresa->id) {
            abort(401);
        }

        return Storage::disk('omieFluxo')->download($empresa->getFluxoCaixa($this->ano));
    }
}
