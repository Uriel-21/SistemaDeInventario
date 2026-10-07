<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\EntradaMateriaPrimaService;
use App\Livewire\Forms\EntradaMateriaPrima;
use App\Services\MateriaPrimaService;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class EntradaPrimaAdmin extends Component
{
    use WithFileUploads;

    public EntradaMateriaPrima $form;

    public $search = '';
    public $nombreMaterialSeleccionado = '';


    public function seleccionarMaterial(int $id, string $nombre)
    {
        $this -> form -> materiaPrimaId = $id;
        $this -> nombreMaterialSeleccionado = $nombre;
        $this -> search = '';
    }

    public function save(EntradaMateriaPrimaService $service)
    {
        $this -> form -> validate();

        try {
            $datos = $this -> form -> all();
            $datos['user_id'] = Auth::id();

            $service -> guardarEntrada($datos);

            $this -> form -> reset();
            $this -> nombreMaterialSeleccionado = '';

            session() -> flash('success', 'Entrada registrada con éxito');
            return $this -> redirectRoute('consultaprima', navigate: true);

        } catch (\Exception $e) {
            Log::error('Falló al guardar la entrada de materia prima: ' . $e->getMessage());
            session() -> flash('error', 'Ocurrió un problema interno al guardar el registro. Intenta nuevamente');
        }
    }

    public function render(EntradaMateriaPrimaService $service)
    {
        $materiaPrima = [];
        if (strlen($this -> search) > 1){
            $materiaPrima = $service -> BuscarSeleccionar($this -> search);
        }
        return view('livewire.admin.entrada-prima-admin', [
            'materiaPrima' => $materiaPrima
        ])->layout('layouts.app');
    }
}
