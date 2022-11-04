<?php

namespace App\Repositories;

use App\Models\Dado;
use App\Models\Grupo;
use App\Models\Tipo;

class ReceitaDespesaRepository
{
    public function getReceitasPorMes(int $mes, int $ano, int $empresaId)
    {
        return $this->getReceitasDespesasPorMes($mes, $ano, $empresaId, 'RECEITAS');
    }

    private function getReceitasDespesasPorMes(int $mes, int $ano, int $empresaId, string $tipo)
    {
        $tipoModel = Tipo::firstOrCreate(['nome' => $tipo]);
        $dados = Dado::whereTipoId($tipoModel->id)
            ->whereEmpresaId($empresaId)
            ->whereDadoAno($ano)
            ->whereDadoMes($mes)
            ->getModels();

        $valor = 0;
        foreach ($dados as $dado) {
            $valor += $dado->valor;
        }

        return $valor;
    }

    public function getDespesasPorMes(int $mes, int $ano, int $empresaId)
    {
        return $this->getReceitasDespesasPorMes($mes, $ano, $empresaId, 'DESPESAS');
    }

    public function getTotalReceitasPorMes(int $mes, int $ano, int $empresaId)
    {
        return $this->getTotalReceitasDespesasPorMes($mes, $ano, $empresaId, 'RECEITAS');
    }

    private function getTotalReceitasDespesasPorMes(int $mes, int $ano, int $empresaId, string $tipo)
    {
        $tipoModel = Tipo::firstOrCreate(['nome' => $tipo]);


        if ($mes == 0) {
            return Dado::with('grupo')->whereTipoId($tipoModel->id)
                ->whereEmpresaId($empresaId)
                ->whereDadoAno($ano)
                ->sum('valor');
        } else {
            return Dado::with('grupo')->whereTipoId($tipoModel->id)
                ->whereEmpresaId($empresaId)
                ->whereDadoAno($ano)
                ->whereDadoMes($mes)
                ->sum('valor');
        }
    }

    public function getTotalDespesasPorMes(int $mes, int $ano, int $empresaId)
    {
        return $this->getTotalReceitasDespesasPorMes($mes, $ano, $empresaId, 'DESPESAS');
    }

    public function getGruposDeDespesas(int $empresaId, int $ano): array
    {
        $gruposDespesas = [];
        $tipoDespesa = Tipo::firstOrCreate(['nome' => 'DESPESAS']);
        $dadosDespesas = Dado::with('grupo')
            ->whereEmpresaId($empresaId)
            ->whereTipoId($tipoDespesa->id)
            ->whereDadoAno($ano)
            ->getModels();

        foreach ($dadosDespesas as $dado) {
            $gruposDespesas[] = $dado->grupo->nome;
        }

        return array_unique($gruposDespesas);
    }

    public function getGruposDeDespesasDatas(int $empresaId, int $ano, array $grupos): array
    {
        $datas = [];

        foreach ($grupos as $grupo) {
            $datas[] = $this->getTotalDespesaPorGrupo($empresaId, $ano, $grupo);
        }

        return $datas;
    }

    public function getTotalDespesaPorGrupo(int $empresaId, int $ano, string $grupo)
    {
        $grupo = Grupo::whereNome($grupo)->first();

        return Dado::whereGrupoId($grupo->id)
            ->whereEmpresaId($empresaId)
            ->whereDadoAno($ano)
            ->sum('valor');
    }

    public function getValoresDetalhesDespesas(int $ano, int $empresaId): array
    {
        $tipoDespesa = Tipo::firstOrCreate(['nome' => 'DESPESAS']);

        $detalhes = Dado::whereTipoId($tipoDespesa->id)
            ->whereEmpresaId($empresaId)
            ->whereDadoAno($ano)->pluck('detalhe')
            ->unique()
            ->toArray();

        sort($detalhes);

        $d = [];
        foreach ($detalhes as $detalhe) {
            $d[$detalhe] = Dado::whereDetalhe($detalhe)->sum('valor');
        }

        return $d;
    }
}
