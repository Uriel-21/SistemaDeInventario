<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\UserService;
use App\Livewire\Forms\UserForm;

class CrearusuariosAdmin extends Component
{
    public UserForm $form;
    public ?string $urlActivacion = null;


    public function save(UserService $service)
    {
        $this -> authorize('crear usuario');

        $this -> form -> validate();

        $data = [
            'name' => $this -> form -> name,
            'email' => $this -> form -> email,
            'telefono' => $this -> form -> telefono,
            'rol' => $this -> form -> rol
        ];

        try {

            $this -> urlActivacion = $service -> registrarConInvitacion($data);

            session() -> flash('mensaje', 'Usuario registrado con éxito.');

            $this -> form -> reset();

        } catch (\Exception $e) {
            session()->flash('error', 'Hubo un problema al guardar el usuario en la base de datos.');
        }
    }

    public function render()
    {
        return view('livewire.admin.crearusuarios-admin')->layout('layouts.app');
    }
}
