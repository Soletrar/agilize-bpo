<div>
    <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
            <thead
                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="py-3 px-6">
                    Nome
                </th>
                <th scope="col" class="py-3 px-6">
                    CNPJ
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($empresas as $empresa)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$empresa->nome}}
                    </th>
                    <td class="py-4 px-6">
                        {{$empresa->cnpj}}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <button wire:click="$emit('openModal', 'empresa.modals.editar-empresa-modal', @json([$empresa->id]))"
                           class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
