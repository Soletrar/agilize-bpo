<?php

namespace App\Http\Livewire\Usuario\Modals;

use App\Http\Livewire\Usuario\UsuariosTabela;
use App\Models\Empresa;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use LivewireUI\Modal\ModalComponent;

class AdicionarUsuarioModal extends ModalComponent
{
    public string $nome = '';
    public string $email = '';
    public string $senha = '';
    public string $empresa = '';

    public function render()
    {
        return view('livewire.usuario.modals.adicionar-usuario-modal', [
            'empresas' => Empresa::orderBy('nome')->getModels()
        ]);
    }

    public function criaUsuario()
    {
        $this->validate();

        User::create([
            'name' => $this->nome,
            'email' => $this->email,
            'password' => Hash::make($this->senha),
            'empresa_id' => empty($this->empresa) ? null : $this->empresa
        ]);

        sweetalert()->addSuccess('O usuário foi cadastrado.', 'Operação Concluída');

        $this->closeModalWithEvents([
            UsuariosTabela::getName() => 'usuarioCriado'
        ]);
    }

    protected function rules(): array
    {
        return [
            'nome' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'senha' => ['required'],
            'empresa' => ['nullable', 'exists:empresas,id']
        ];
    }
}
