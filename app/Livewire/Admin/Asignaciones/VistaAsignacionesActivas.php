<?php

namespace App\Livewire\Admin\Asignaciones;

use Livewire\Component;
use App\Services\AsignacionesService;
use Livewire\Attributes\On;

class VistaAsignacionesActivas extends Component
{
    #[On('asignacion-actualizada')]
    public function render(AsignacionesService $service)
    {
        return view('livewire.admin.asignaciones.vista-asignaciones-activas', [
            'asignaciones' => $service -> obtenerAsignacionesPendientes()
        ])->layout('layouts.app');
    }
}
