<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\LotesEmpaquetadosService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Livewire\Forms\LoteEmpaquetado;

class AgregarLoteAdmin extends Component
{

    public LoteEmpaquetado $form;

    public $search = '';
    public $nombreModeloSeleccionado = '';
    public $tallaSelect = '';
    public $codigoSelect = '';

    public function seleccionarModelo(int $id, string $nombre, string $codigo, string $talla)
    {
        $this -> form -> producto_id = $id;
        $this -> nombreModeloSeleccionado = $nombre;
        $this -> tallaSelect = $talla;
        $this -> codigoSelect = $codigo;
        $this -> search = $codigo;
    }

    public function save(LotesEmpaquetadosService $service)
    {
        try {

        $this -> form -> user_id = Auth::id();
        $this -> form -> estado = 'En almacen';

        $this -> form -> validate();

        $datos = [
            'user_id' => $this -> form -> user_id,
            'producto_id' => $this -> form -> producto_id,
            'estado' => $this -> form -> estado,
            'cantidad' => $this -> form -> cantidad
        ];

        $service -> guardarLoteConEtiqueta($datos);

        $this -> form -> reset();
        $this -> search = '';
        $this -> nombreModeloSeleccionado = '';
        $this -> tallaSelect = '';
        $this -> codigoSelect = '';

        session() -> flash('success', 'Lote guardado correctamente');

        } catch (\Exception $e) {
            Log::error('Error al guardar el lote (frontend, componente): ' . $e->getMessage());
            session() -> flash('error', 'Error al guardar el lote, intente nuevamente');
            //throw $e;
        }

    }

    public function cancelarRegresar()
    {
        $this -> reset();
        $this -> resetValidation();
        return $this -> redirectRoute('historiallotes');
    }

    public function render(LotesEmpaquetadosService $service)
    {
        $modelos = [];
        if(strlen($this -> search) > 1) {
            $modelos = $service -> buscarSeleccionar($this -> search);
        }
        return view('livewire.admin.agregar-lote-admin', [
            'modelos' => $modelos
        ])->layout('layouts.app');
    }
}
