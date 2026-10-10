<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class VistaAsignacionesAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.vista-asignaciones-admin')->layout("layouts.app");
    }
}
