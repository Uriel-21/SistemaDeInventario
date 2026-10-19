<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AlmacenProductoTerminadoService;
use App\Livewire\Forms\AlmacenProductoTerminado;
use PhpParser\Node\Expr\FuncCall;
use Psy\CodeCleaner\FunctionContextPass;
use Illuminate\Support\Facades\Log;

class ModificarModeloAdmin extends Component
{
    public AlmacenProductoTerminado $form;
    protected AlmacenProductoTerminadoService $service;

    public function boot(AlmacenProductoTerminadoService $service) : void
    {
        $this -> service = $service;
    }

    public function mount(int $id) : void
    {
        $this -> form -> cargar($this -> service -> obtenerDatrosEdicion($id));
    }

    public function save()
    {
        $datos = $this -> form -> validate();

        try {

            $this -> service -> modificarModelo($this -> form -> productoTerminadoId, $datos);
            session() -> flash('success', 'Modelo actualizado correctamente');
            return redirect() -> route('productoterminado');

        } catch (\Exception $e) {

            Log::error('Error al actualizar el modelo (frontend, componente): ' . $e->getMessage());
            session() -> flash('error', 'Ocurrio un error al actualizar el registro, intente de nuevo');
            throw $e;

        }
    }

    public function cancelarRegresar()
    {
        $this -> reset();
        $this -> resetValidation();
        return $this -> redirectRoute('productoterminado');
    }

    public function render()
    {
        return view('livewire.admin.modificar-modelo-admin')->layout('layouts.app');
    }
}
