<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Livewire\Forms\AjusteInventario;
use App\Services\AjusteInventarioServices;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class AjusteInventarioAdmin extends Component
{

    public AjusteInventario $form;

    public $search = '';
    public $nombreMaterialSeleccionado = '';

    public function seleccionarMaterial(int $id, string $nombre)
    {
        $this -> form -> materiaPrimaId = $id;
        $this -> nombreMaterialSeleccionado = $nombre;
        $this -> search = '';
    }

    public function save(AjusteInventarioServices $service)
    {
        $this -> form -> validate();

        try {
            $datos = $this -> form -> all();
            $datos['user_id'] = Auth::id();

            $service -> guardarAjuste($datos);

            $this -> form -> reset();
            $this -> nombreMaterialSeleccionado = '';

            session() -> flash('success', 'Ajuste de inventario guardado con éxito');
            return $this -> redirectRoute('vistaajusteinventario', navigate: true);

        } catch (\Exception $e) {
            Log::error('Fallo al guardar el ajuste de inventario: ' . $e -> getMessage());
            session() -> flash('error', 'Ocurrio un problema interno al guardar el ajuste de inventario. Intente nuevamente');
            $this -> addError('form.cantidad_dm', $e -> getMessage());
        }
    }

    public function render(AjusteInventarioServices $service)
    {
        $materiaPrima = [];
        if(strlen($this -> search) > 1) {
            $materiaPrima = $service -> BuscarSeleccionar($this -> search);
        }

        return view('livewire.admin.ajuste-inventario-admin', [
            'materiaPrima' => $materiaPrima
        ])->layout('layouts.app');
    }
}
