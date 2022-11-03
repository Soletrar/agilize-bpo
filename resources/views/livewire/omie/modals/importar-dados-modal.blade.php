<div>
    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
        <button wire:click="closeModal" type="button"
                class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                data-modal-toggle="authentication-modal">
            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                 xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                      d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                      clip-rule="evenodd"></path>
            </svg>
            <span class="sr-only">Close modal</span>
        </button>
        <div class="py-6 px-6 lg:px-8">
            <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Importar Dados</h3>
            <form class="space-y-6" action="{{route('dashboard.omie.import')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div>
                    <label for="ano" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Ano de Origem</label>
                    <select required id="ano" name="ano"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Escolha um ano</option>
                        @foreach($anos as $ano)
                            <option value="{{$ano}}">{{$ano}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="mes" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Mês de Origem</label>
                    <select required id="mes" name="mes"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Escolha um mês</option>
                        @foreach($meses as $mes)
                            <option value="{{$mes['code']}}">{{$mes['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label for="empresas" class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-400">Empresa</label>
                    <select required id="empresas" name="empresa"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="">Escolha uma empresa</option>
                        @foreach($empresas as $empresa)
                            <option value="{{$empresa->id}}">{{$empresa->nome}} ({{$empresa->cnpj}})</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-gray-300" for="file_input">
                        Arquivo de Dados (.csv)
                    </label>
                    <input name="file" accept="text/csv" required
                           class="block w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 cursor-pointer dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                           id="file_input" type="file">
                </div>
                <button type="submit" class="w-full mt-3 btn-primary"><i class="fa-solid fa-file-import"></i> Importar</button>
            </form>
        </div>
    </div>
</div>
