<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Fluxo de Caixa ({{$empresa->nome}})
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="h-96 mb-10 p-5 pb-16 border-b-2">
                        <canvas id="ReceitaDespesaChart" height="200"></canvas>
                    </div>

                    <div class="h-96 mb-10 p-5 pb-16 border-b-2">
                        <canvas id="faturamentoChart" height="200"></canvas>
                    </div>

                    <div class="h-96 mb-10 p-5">
                        <canvas id="despesasChart" height="200"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{asset('js/chart.js')}}"></script>
    <script>
        function random_rgba() {
            const o = Math.round, r = Math.random, s = 255;
            return 'rgba(' + o(r() * s) + ',' + o(r() * s) + ',' + o(r() * s) + ',' + r().toFixed(1) + ')';
        }

        let ctx = document.getElementById('ReceitaDespesaChart').getContext('2d');

        let data = {
            labels: [
                @foreach($receitaDespesaLabels as $label)
                    '{{$label}}',
                @endforeach
            ],
            datasets: [
                {
                    label: 'Receita',
                    data: [
                        @foreach($receitaDatas as $data)
                            {{$data}},
                        @endforeach
                    ],
                    borderColor: 'rgba(0, 255, 153, 1)',
                    backgroundColor: 'rgba(0, 255, 153, 0.5)',
                },
                {
                    label: 'Despesa',
                    data: [
                        @foreach($despesaDatas as $data)
                            {{$data}},
                        @endforeach
                    ],
                    borderColor: 'rgba(252, 3, 44, 1)',
                    backgroundColor: 'rgba(252, 3, 44, 0.5)',
                }
            ]
        };

        let config = {
            type: 'bar',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Receitas e Despesas ({{$ano}})'
                    },
                },
                locale: 'pt-BR'
            },
        };

        new Chart(ctx, config) // receitas/despesas chart

        ctx = document.getElementById('faturamentoChart').getContext('2d');

        let labels = [
            @foreach($receitaDespesaLabels as $label)
                '{{$label}}',
            @endforeach
        ];

        data = {
            labels: labels,
            datasets: [{
                label: 'Resultado',
                data: [
                    @foreach($faturamentoDatas as $data)
                        {{$data}},
                    @endforeach
                ],
                fill: false,
                borderColor: 'rgb(51, 204, 255)',
                tension: 0.1
            }]
        };

        config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Resultado ({{$ano}})'
                    },
                },
                locale: 'pt-BR'
            },
        };

        new Chart(ctx, config) // faturamento chart

        data = {
            labels: [
                @foreach($despesasLabels as $label)
                    '{{$label}}',
                @endforeach
            ],
            datasets: [{
                label: '',
                data: [
                    @foreach($despesasGruposDatas as $data)
                        {{$data}},
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($despesasLabels as $label)
                        'rgba({{rand(0, 255)}}, {{rand(0, 255)}}, {{rand(0, 255)}}, 0.5)',
                    @endforeach
                ],
                hoverOffset: 4
            }]
        };

        config = {
            type: 'pie',
            data: data,
            options: {
                responsive: true,
                maintainAspectRatio: false,
                interaction: {
                    intersect: false,
                    mode: 'index',
                },
                plugins: {
                    title: {
                        display: true,
                        text: 'Despesas ({{$ano}})'
                    },
                },
                // scales: {
                //     x: {
                //         stacked: true,
                //     },
                //     y: {
                //         beginAtZero: true,
                //         stacked: true
                //     }
                // }
            }
        };

        ctx = document.getElementById('despesasChart').getContext('2d');
        new Chart(ctx, config) // despesas chart

    </script>
</x-app-layout>
