<?php

namespace App\Livewire\Layouts;

use Livewire\Component;
use App\Services\AjusteInventarioServices;
use App\Models\AjustesInventario;
use Livewire\Attributes\On;

class ModalAjustesAdmin extends Component
{

    public ?AjustesInventario $detalle = null;

    #[On('cargarDetalles')]
    public function cargar(int $id, AjusteInventarioServices $service)
    {
        $this -> detalle = $service -> obtenerDetalleAjusteInventario($id);
        $this -> dispatch('abrir-modal-detalles');
    }

    public function render()
    {
        return view('livewire.layouts.modal-ajustes-admin')->layout('layouts.app');
    }
}
