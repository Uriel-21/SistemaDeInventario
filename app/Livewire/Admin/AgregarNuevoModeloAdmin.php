<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AlmacenProductoTerminadoService;
use App\Livewire\Forms\AlmacenProductoTerminado;
use Illuminate\Support\Facades\Log;

class AgregarNuevoModeloAdmin extends Component
{
    public AlmacenProductoTerminado $form;

    public function render()
    {
        return view('livewire.admin.agregar-nuevo-modelo-admin')->layout('layouts.app');
    }

    public function save(AlmacenProductoTerminadoService $service)
    {
        $this -> form -> validate();

        try {

            $datos = $this -> form -> all();
            $service -> guardarModelo($datos);
            $this -> form -> reset();

            session() -> flash('success', 'Modelo registrado con éxito');
            return $this -> redirectRoute('productoterminado', navigate:true);


        } catch (\Exception $e) {
            Log::error('Error al guardar el modelo (frontend, componente): ' . $e->getMessage());
            session() -> flash('error', 'Ocurrió un error al guardar el modelo, intente de nuevo');
        }
    }
}
