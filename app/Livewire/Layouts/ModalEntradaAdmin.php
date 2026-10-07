<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use App\Services\EntradaMateriaPrimaService;
use App\Models\EntradaMateriaPrima;
use Livewire\Attributes\On;

class ModalEntradaAdmin extends Component
{
    public ?EntradaMateriaPrima $detalle = null;

    #[On('cargarDetalles')]
    public function cargar(int $id,  EntradaMateriaPrimaService $service)
    {
        $this -> detalle = $service -> obtenerDetalleEntrada($id);
        $this -> dispatch('abrir-modal-detalles');
    }

    public function render()
    {
        return view('livewire.layouts.modal-entrada-admin')->layout('layouts.app');
    }
}
