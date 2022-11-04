<?php

namespace App\Http\Livewire\Omie\Graficos;

use App\Models\Dado;
use App\Models\Empresa;
use App\Repositories\ReceitaDespesaRepository;
use Livewire\Component;

class Cartoes extends Component
{
    public $ano = 0;
    public $mes = 0;
    public string $nomeMes = 'Anual';

    public $anos = [];
    public $meses = [];

    public Empresa $empresa;

    public function mount()
    {
        $this->updateAnos();
        $this->updateMeses();
    }

    public function updateAnos()
    {
        $anos = Dado::whereEmpresaId($this->empresa->id)
            ->pluck('dado_ano')
            ->unique()
            ->toArray();

        sort($anos);

        $this->ano = end($anos);

        $this->anos = $anos;
    }

    public function updateMeses()
    {
        $meses = Dado::whereEmpresaId($this->empresa->id)
            ->whereDadoAno($this->ano)
            ->pluck('dado_mes')
            ->unique()
            ->toArray();

        sort($meses);

        $mesesArray = [];

        foreach ($meses as $mes) {
            $mesesArray[] = ['nome' => ucfirst(now()->startOfMonth()->setMonth($mes)->monthName), 'codigo' => $mes];
        }

        $this->meses = $mesesArray;
    }

    public function render(ReceitaDespesaRepository $receitaDespesaRepository)
    {
        $receitas = $receitaDespesaRepository->getTotalReceitasPorMes($this->mes, $this->ano, $this->empresa->id);
        $despesas = $receitaDespesaRepository->getTotalDespesasPorMes($this->mes, $this->ano, $this->empresa->id);
        $faturamento = $receitas + $despesas;

        $indice = 0;
        if ($receitas != 0 && $despesas != 0) {
            $indice = $faturamento/$receitas * 100;
        }

        return view('livewire.omie.graficos.cartoes', [
            'receitaTotalMes' => 'R$ ' . number_format($receitas, 2, ',', '.'),
            'despesaTotalMes' => 'R$ ' . number_format($despesas, 2, ',', '.'),
            'faturamentoTotalMes' => 'R$ ' . number_format($faturamento, 2, ',', '.'),
            'indice' => $indice,
        ]);
    }

    protected function updatedAno()
    {
        $this->mes = 0;
        $this->nomeMes = 'Anual';
        $this->updateMeses();
    }

    protected function updatedMes()
    {
        $this->nomeMes = $this->mes == 0 ? 'Anual' : ucfirst(now()->startOfMonth()->setMonth($this->mes)->monthName);
    }
}
