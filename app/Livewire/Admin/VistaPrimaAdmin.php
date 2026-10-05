<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\MateriaPrimaService;
use Livewire\WithPagination;

class VistaPrimaAdmin extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this -> resetPage();
    }

    public function desactivar(int $id, MateriaPrimaService $service)
    {
        try {

            $service -> desactivarRegistro($id);
            session() -> flash('mensaje', 'Registro eliminado correctamente');

        } catch (Exception $e) {
            session() -> flash('error', 'Ocurrio un problema al intentar borrar el registro');
        }
    }

    public function render(MateriaPrimaService $service)
    {
        $materiaPrima = $service -> obtenerDatosMateriaPrima($this -> search);

        return view('livewire.admin.vista-prima-admin',[
        'materiaPrima' => $materiaPrima])
        ->layout('layouts.app');
    }
}
