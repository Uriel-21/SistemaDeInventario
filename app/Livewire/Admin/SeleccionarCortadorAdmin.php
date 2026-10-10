<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class SeleccionarCortadorAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.seleccionar-cortador-admin')->layout("layouts.app");
    }
}
