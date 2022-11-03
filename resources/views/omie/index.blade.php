<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Fluxo de Caixa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($errors->any())
                <div id="alert" class="flex p-4 mb-4 text-sm text-red-700 bg-red-100 rounded-lg dark:bg-red-200 dark:text-red-800" role="alert">
                    <svg aria-hidden="true" class="flex-shrink-0 inline w-5 h-5 mr-3" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path></svg>
                    <span class="sr-only">Danger</span>
                    <div>
                        <span class="font-medium">Por favor revise os erros a seguir:</span>
                        <ul class="mt-1.5 ml-4 text-red-700 list-disc list-inside">
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <button type="button" class="ml-auto -mx-1.5 -my-1.5 bg-red-100 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex h-8 w-8 dark:bg-red-200 dark:text-red-600 dark:hover:bg-red-300" data-dismiss-target="#alert" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                </div>
            @endif

            <div class="flex justify-end">
                <div>
                    <button type="button" class="mb-3 btn-primary" onclick="Livewire.emit('openModal', 'omie.modals.gerar-graficos-modal')">
                        <i class="fa-solid fa-chart-simple"></i> Gerar Gráficos
                    </button>

                    @if(auth()->user()->empresa_id != null && auth()->user()->empresa->hasFluxoCaixa())
                        <a href="{{route('dashboard.omie.download-fluxo', ['empresa' => auth()->user()->empresa_id])}}" type="button" class="mb-3 btn-primary" target="_blank">
                            <i class="fa-solid fa-download"></i> Baixar Fluxo de Caixa
                        </a>
                    @endif

                    @if(auth()->user()->admin)
                        <button type="button" class="mb-3 btn-primary" onclick="Livewire.emit('openModal', 'omie.modals.importar-dados-modal')">
                            <i class="fa-solid fa-file-import"></i> Importar Dados
                        </button>

                        <button type="button" class="mb-3 btn-primary" onclick="Livewire.emit('openModal', 'omie.modals.importar-fluxo-caixa-modal')">
                            <i class="fa-solid fa-file-invoice"></i> Importar Fluxo de Caixa
                        </button>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @if(auth()->user()->empresa_id != null)
                        <div class="mb-6">
                            @livewire('omie.graficos.cartoes', ['empresa' => auth()->user()->empresa])
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
