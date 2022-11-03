<div>
    <div class="flex flex-col justify-center gap-2 bg-gray-50 p-4">
        <div class="flex justify-center gap-2">
            <div class="w-24">
                <select id="anos" wire:model="ano" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    @foreach($anos as $ano)
                        <option value="{{$ano}}">{{$ano}}</option>
                    @endforeach
                </select>
            </div>

            <div class="w-44">
                <select id="meses" wire:model="mes" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="0">Selecione um mês</option>
                    @foreach($meses as $mes)
                        <option value="{{$mes['codigo']}}">{{$mes['nome']}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="flex flex-col lg:flex-row justify-center gap-2">
            <div class="rounded p-7 bg-green-100">
                <p class="font-medium">Total de Receitas ({{$nomeMes}})</p>
                <p class="font-bold text-xl">{{$receitaTotalMes}}</p>
            </div>

            <div class="rounded p-7 bg-red-100">
                <p class="font-medium">Total de Despesas ({{$nomeMes}})</p>
                <p class="font-bold text-xl">{{$despesaTotalMes}}</p>
            </div>

            <div class="rounded p-7 bg-blue-100">
                <p class="font-medium">Resultado ({{$nomeMes}})</p>
                <p class="font-bold text-xl">{{$faturamentoTotalMes}}</p>
            </div>

            <div class="rounded p-7 bg-gray-200">
                <p class="font-medium">Índice ({{$nomeMes}})</p>
                @if($indice > 0)
                    <p class="font-bold text-xl"><i class="fa-solid fa-arrow-up text-green-400"></i> {{number_format($indice, 2)}}%</p>
                @elseif($indice < 0)
                    <p class="font-bold text-xl"><i class="fa-solid fa-arrow-down text-red-400"></i> {{number_format($indice, 2)}}%</p>
                @else
                    <p class="font-bold text-xl">{{number_format($indice, 2)}}%</p>
                @endif
            </div>
        </div>
    </div>
</div>
