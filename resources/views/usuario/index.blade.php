<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Usuários') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end mb-3">
                <div>
                    <button type="button" class="btn-primary"
                            onclick="Livewire.emit('openModal', 'usuario.modals.adicionar-usuario-modal')">
                        <i class="fa-solid fa-plus"></i> Adicionar Usuário
                    </button>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    @livewire('usuario.usuarios-tabela')

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
