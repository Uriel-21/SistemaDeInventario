<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use App\Services\AjusteInventarioProductoTerminadoService;
use Livewire\Attributes\On;
use App\Models\AjusteInventarioProductoTerminado;

class ModalHistorialAjusteInventarioProductoTerminadoAdmin extends Component
{
    public ?AjusteInventarioProductoTerminado $detalle = null;

    #[On('cargarDetallesProductoTerminado')]
    public function cargar(int $id, AjusteInventarioProductoTerminadoService $service)
    {
        $this -> detalle = $service -> obtenerDetalleAjusteInventario($id);
        $this -> dispatch('abrir-modal-detalles-producto-terminado');
    }

    public function render()
    {
        return view('livewire.layouts.modal-historial-ajuste-inventario-producto-terminado-admin')->layout('layouts.app');
    }
}
