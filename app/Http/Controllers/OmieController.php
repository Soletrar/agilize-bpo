<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportarFluxoCaixaRequest;
use App\Http\Requests\Omie\GerarGraficosRequest;
use App\Http\Requests\Omie\ImportarDadosRequest;
use App\Models\Dado;
use App\Models\Detalhe;
use App\Models\Empresa;
use App\Models\Grupo;
use App\Models\Tipo;
use App\Repositories\ReceitaDespesaRepository;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OmieController extends Controller
{
    public function index()
    {
        return view('omie.index');
    }

    public function graficos(ReceitaDespesaRepository $empresaDespesaRepository, GerarGraficosRequest $request)
    {
        $receitaDatas = [];
        $despesaDatas = [];
        $faturamentoDatas = [];
        $chartLabels = [];

        $empresa = Empresa::find($request->input('empresa'));
        $ano = $request->input('ano');

        $meses = Dado::whereEmpresaId($empresa->id)
            ->whereDadoAno($ano)
            ->pluck('dado_mes')
            ->unique()
            ->toArray();

        sort($meses);

        foreach ($meses as $mes) {
            $chartLabels[] = ucfirst(now()->startOfMonth()->setMonth($mes)->monthName);

            $receitas = $empresaDespesaRepository->getReceitasPorMes($mes, $ano, $empresa->id);
            $despesas = $empresaDespesaRepository->getDespesasPorMes($mes, $ano, $empresa->id);

            $receitaDatas[] = $receitas;
            $despesaDatas[] = $despesas;
            $faturamentoDatas[] = $receitas + $despesas;
        }

        $despesasLabels = $empresaDespesaRepository->getGruposDeDespesas($empresa->id, $ano);

        return view('omie.graficos', [
            'empresa' => $empresa,
            'ano' => $ano,
            'receitaDespesaLabels' => $chartLabels,
            'receitaDatas' => $receitaDatas,
            'despesaDatas' => $despesaDatas,
            'faturamentoDatas' => $faturamentoDatas,
            'despesasLabels' => $despesasLabels,
            'despesasGruposDatas' => $empresaDespesaRepository->getGruposDeDespesasDatas($empresa->id, $ano, $despesasLabels),
        ]);
    }

    public function import(ImportarDadosRequest $request)
    {
        $year = $request->input('ano');
        $month = $request->input('mes');

        $fileContent = $request->file('file')->getContent();
        $fileContentLines = Str::of($fileContent)->explode("\n");

        foreach ($fileContentLines as $line) {
            if (empty($line) || Str::startsWith($line, 'Período')) continue;

            $lineCsv = str_getcsv($line, ';');

            $data = [];
            $data['periodo'] = $lineCsv[0];
            $data['mes'] = $lineCsv[1];
            $data['ordem'] = $lineCsv[2];

            $grupo = Grupo::firstOrCreate(['nome' => $lineCsv[4]]);
            $data['grupo_id'] = $grupo->id;
            Detalhe::create(['nome' => $lineCsv[3], 'grupo_id' => $grupo->id]);

            $data['tipo_id'] = Tipo::firstOrCreate(['nome' => $lineCsv[5]])->id;

            $data['cliente_fornecedor'] = $lineCsv[6];
            $data['vencimento'] = empty($lineCsv[7]) ? NULL : Carbon::createFromFormat('m/d/Y', $lineCsv[7]);
            $data['valor'] = str_replace(',', '.', $lineCsv[8]);

            $data['dado_ano'] = $year;
            $data['dado_mes'] = $month;
            $data['empresa_id'] = $request->input('empresa');

            $dado = Dado::create($data);


        }

        sweetalert()->addSuccess('Os dados foram importados.', 'Operação Concluída');

        return redirect()->route('dashboard.omie.index');
    }

    public function importFluxo(ImportarFluxoCaixaRequest $request)
    {
        $empresa = Empresa::find($request->input('empresa'));
        $empresa->deleteFluxoCaixa($request->input('ano'));

        $file = $request->file('file');

        $file->storeAs($empresa->id . '/' . $request->input('ano'), $file->getClientOriginalName(), 'omieFluxo');

        sweetalert()->addSuccess('Arquivo importado com sucesso!', 'Operação Concluída');

        return redirect()->route('dashboard.omie.index');
    }
}
