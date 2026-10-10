<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Livewire\Forms\DevolucionMateriaPrima;
use App\Services\DevolucionMateriaPrimaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\WithFileUploads;

class DevolucionPrimaAdmin extends Component
{
    use WithFileUploads;

    public DevolucionMateriaPrima $form;

    public $search = '';
    public $nombreMaterialSeleccionado = '';

    public function seleccionarMaterial(int $id, string $nombre)
    {
        $this -> form -> materiaPrimaId = $id;
        $this -> nombreMaterialSeleccionado = $nombre;
        $this -> search = '';
    }


    public function save(DevolucionMateriaPrimaService $service)
    {
        $this -> form -> validate();

        try {

            $datos = $this -> form -> all();
            $datos['user_id'] = Auth::id();

            $service -> guardarDevolucion($datos);

            $this -> form -> reset();
            $this -> nombreMaterialSeleccionado = '';

            session() -> flash('success', 'Devolución registrada con éxito');
            return $this -> redirectRoute('vistadevolucionprima');

        } catch (\Exception $e) {

            Log::error('Fallo al guardar la devolución de la materia prima' . $e->getMessage());
            session() -> flash('error', 'Ocurrio algun problema interno al guardar la devolución. Intenta nuevamente');
            $this -> addError('form.cantidad_dm', $e -> getMessage());
        }
    }

    public function render(DevolucionMateriaPrimaService $service)
    {   $materiaPrima = [];

        if(strlen($this -> search) > 1){
            $materiaPrima = $service -> BuscarSeleccionar($this -> search);
        }

        return view('livewire.admin.devolucion-prima-admin', [
            'materiaPrima' => $materiaPrima
        ])->layout('layouts.app');
    }
}
