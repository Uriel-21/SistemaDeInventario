<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\UserService;
use App\Livewire\Forms\UserForm;

class CrearusuariosAdmin extends Component
{
    public UserForm $form;
    public $password = '';

    public function mount(UserService $service)
    {
        $this -> password = $service -> generarPassword();
    }

    // Se puede quitar si no se necesita
    public function generarNuevaPassword(UserService $servicio)
    {
        $this->password = $servicio->generarPassword();
    }

    public function save(UserService $service)
    {
        $this -> form -> validate();

        $nombreCompleto = trim($this ->form -> first_name . ' ' . $this -> form -> last_name);

        $data = [
            'name' => $nombreCompleto,
            'email' => $this -> form -> email,
            'telefono' => $this -> form -> telefono,
            'password' => $this -> password
        ];

        try {

            $service -> guardarUsuario($data);

            session() -> flash('mensaje', 'Usuario registrado con éxito. Contraseña: ' . $this -> password);

            $this -> form -> reset();
            $this -> password = $service -> generarPassword();

        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un problema al guardar el usuario en la base de datos.');
        }
    }

    public function render()
    {
        return view('livewire.admin.crearusuarios-admin')->layout('layouts.app');
    }
}
