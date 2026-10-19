<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AlmacenProductoTerminadoService;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;
use Psy\CodeCleaner\FunctionContextPass;

class VistaProductoTerminadoAdmin extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this -> resetPage();
    }

    public function desactivar(int $id, AlmacenProductoTerminadoService $service)
    {
        try {

            $service -> desactivarRegistro($id);
            session() -> flash('success', 'Registro eliminado correctamente');

        } catch (\Exception $e) {
            Log::error('Ocurrio un error al borrar el registro (frontend, componente): ', $e->getMessage());
            session() -> flash('error', 'Ocurrio un error al borrar el registro, intente nuevamente');
            throw $e;
        }
    }

    public function render(AlmacenProductoTerminadoService $service)
    {
        $productosTerminados = $service -> obtenerDatosAlmacenProductoTerminado($this -> search);

        return view('livewire.admin.vista-producto-terminado-admin', [
            'productosTerminados' => $productosTerminados
        ])->layout('layouts.app');
    }
}
