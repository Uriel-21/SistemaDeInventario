<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Livewire\Forms\AjusteDeInventarioProductoTerminado;
use App\Services\AjusteInventarioProductoTerminadoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AjusteDeInventarioProductoTerminadoAdmin extends Component
{
    public AjusteDeInventarioProductoTerminado $form;

    public function save(AjusteInventarioProductoTerminadoService $service)
    {
        $this -> authorize('registrar ajuste de producto terminado');

        try {

            $datos = $this -> form -> validate();
            $datos['user_id'] = Auth::id();

            $service -> guardarAjuste($datos);

            $this -> form -> reset();

            session()-> flash('success', 'Ajuste de inventario guardado con éxito');
            return $this -> redirectRoute('historialAjusteProductoTerminado.show', navigate: true);

        } catch (\Exception $e) {

            Log::error('Fallo al guardar el ajuste de inventario: ' . $e -> getMessage());
            session() -> flash('error', 'Ocurrio un problema interno al guardar el ajuste de inventario. Intente nuevamente');
            $this -> addError('form.codigo_barras', $e -> getMessage());
        }
    }

    public function cancelarRegresar()
    {
        $this -> reset();
        $this -> resetValidation();
        return $this -> redirectRoute('historialAjusteProductoTerminado.show');
    }

    public function render()
    {
        return view('livewire.admin.ajuste-de-inventario-producto-terminado-admin')->layout('layouts.app');
    }
}
