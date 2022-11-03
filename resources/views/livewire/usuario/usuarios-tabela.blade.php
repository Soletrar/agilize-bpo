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
                    E-mail
                </th>
                <th scope="col" class="py-3 px-6">
                    Empresa
                </th>
                <th scope="col" class="py-3 px-6">
                    <span class="sr-only">Edit</span>
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($usuarios as $usuario)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                    <th scope="row"
                        class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{$usuario->name}}
                    </th>
                    <td class="py-4 px-6">
                        {{$usuario->email}}
                    </td>
                    <td class="py-4 px-6">
                        {{$usuario->empresa->nome ?? '-'}}
                    </td>
                    <td class="py-4 px-6 text-right">
                        <button wire:click="$emit('openModal', 'usuario.modals.editar-usuario-modal', @json([$usuario->id]))"
                                class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Editar</button>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
