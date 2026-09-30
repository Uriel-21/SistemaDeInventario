<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\UserService;
use Livewire\WithPagination;

class VistausuariosAdmin extends Component
{

    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function desactivar(int $id, UserService $service)
    {
        try {

            $service -> desactivarUsuario($id);
            session()->flash('mensaje', 'Usuario desactivado correctamente.');

        } catch (\Exception $e)  {
            session()->flash('error', 'Hubo un problema al intentar desactivar el usuario.');
        }
    }
    public function render(UserService $servicio)
    {
        $usuarios = $servicio->obtenerUsuarios($this->search);

        return view('livewire.admin.vistausuarios-admin', [
            'usuarios' => $usuarios
        ])->layout('layouts.app');
    }
}
