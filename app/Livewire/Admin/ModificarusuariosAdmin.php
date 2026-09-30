<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\UserService;
use App\Livewire\Forms\UserForm;

class ModificarusuariosAdmin extends Component
{
    public UserForm $form;

    protected UserService $service;

    public function boot(UserService $service) : void
    {
        $this -> service = $service;
    }

     public function mount(int $id): void
    {
        $this -> form-> cargar($this -> service -> obtenerDatos($id));
    }

    public function save()
    {
        $datos = $this -> form -> validate();

        $datos['name'] = trim($datos['first_name'] . ' ' . $datos['last_name']);
        unset($datos['first_name'], $datos['last_name']);

        $this -> service -> modificarUsuario($this -> form -> userId, $datos);

        session() -> flash('mensaje', 'Usuario actualizado correctamente');
        return redirect() -> route('usuarios');
    }

    public function render()
    {
        return view('livewire.admin.modificarusuarios-admin')->layout('layouts.app');
    }
}
