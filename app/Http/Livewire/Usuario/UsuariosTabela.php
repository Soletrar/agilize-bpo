<?php

namespace App\Http\Livewire\Usuario;

use App\Models\User;
use Livewire\Component;

class UsuariosTabela extends Component
{
    protected $listeners = [
        'usuarioCriado' => '$refresh',
        'usuarioAtualizado' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.usuario.usuarios-tabela', [
            'usuarios' => User::with('empresa')->orderBy('name')->getModels()
        ]);
    }
}
