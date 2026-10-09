<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use App\Services\DevolucionMateriaPrimaService;
use App\Models\DevolucionMateriaPrima;
use Livewire\Attributes\On;

class ModalDevolucionAdmin extends Component
{
    public ?DevolucionMateriaPrima $detalle = null;

    #[On('cargarDetalles')]
    public function cargar(int $id, DevolucionMateriaPrimaService $service)
    {
        $this -> detalle = $service -> obtenerDetallesDevolucion($id);
        $this -> dispatch('abrir-modal-detalles');
    }

    public function render()
    {
        return view('livewire.layouts.modal-devolucion-admin')->layout('layouts.app');
    }
}
