<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Livewire\Forms\SalidaProductoTerminado;
use App\Services\SalidaProductoTerminadoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class RegistrarSalidaAdmin extends Component
{
    public SalidaProductoTerminado $form;

    public function save(SalidaProductoTerminadoService $service)
    {
        $this -> form -> user_id = Auth::id();
        $this -> form -> validate();

        $datos = [
            'codigo_barras' => $this -> form -> codigo_barras,
            'cliente' => $this -> form -> cliente,
            'user_id' => $this -> form -> user_id,
        ];

        try {

            $service -> guardarSalida($datos);

            session() -> flash('success', 'Salida registrada exitosamente');
            $this -> form -> reset();

        } catch (\Exception $e) {

            Log::error('Error al guardar la salida (frontend, componente): .' . $e -> getMessage());
            session() -> flash('error', 'Ocurrio un error al guardar la salida intentelo de nuevo');
        }
    }


    public function render()
    {
        return view('livewire.admin.registrar-salida-admin')->layout('layouts.app');
    }
}
