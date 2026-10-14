<?php

namespace App\Livewire\Admin\Asignaciones;

use Livewire\Component;

class AsignacionesIndex extends Component
{
    public function render()
    {
        return view('livewire.admin.asignaciones.asignaciones-index')->layout('layouts.app');
    }
}
