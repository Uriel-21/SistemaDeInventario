<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AgregarNuevoModeloAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.agregar-nuevo-modelo-admin')->layout('layouts.app');
    }
}
