<?php

namespace App\Http\Livewire\Usuario\Modals;

use App\Http\Livewire\Usuario\UsuariosTabela;
use App\Models\Empresa;
use App\Models\User;
use LivewireUI\Modal\ModalComponent;

class EditarUsuarioModal extends ModalComponent
{
    public User $user;
    public string $senha = '';

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function render()
    {
        return view('livewire.usuario.modals.editar-usuario-modal', [
            'empresas' => Empresa::orderBy('nome')->getModels()
        ]);
    }

    public function atualizaUsuario()
    {
        $this->validate();

        if(!empty($this->senha)) {
            $this->user->password = \Hash::make($this->senha);
        }

        if (empty($this->user->empresa_id)) {
            $this->user->empresa_id = null;
        }

        $this->user->save();

        sweetalert()->addSuccess('O usuário foi atualizado.', 'Operação Concluída');

        $this->closeModalWithEvents([
            UsuariosTabela::getName() => 'usuarioAtualizado'
        ]);
    }

    protected function rules(): array
    {
        return [
            'user.name' => ['required', 'string', 'max:255'],
            'user.email' => ['required', 'string', 'email', 'max:255'],
            'user.empresa_id' => ['nullable', 'exists:empresas,id']
        ];
    }
}
