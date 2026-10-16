<?php

namespace App\Livewire\Admin\Asignaciones;

use Livewire\Component;
use App\Livewire\Forms\Asignaciones;
use App\Services\AsignacionesService;

class CrearAsignacion extends Component
{

    public Asignaciones $form;

    public $searchMaterial = '';
    public $nombreMaterialSeleccionado = '';

    public $searchCortador = '';
    public $nombreCortadorSeleccionado = '';

    public float $cantidad_dm;
    public float $cantidad_estimada;
    public float $stock_disponible = 0;
    public float $cortes_estimados;

    public function seleccionarMaterial(int $id, string $nombre, float $stock)
    {
        $this -> form -> stock_material_id = $id;
        $this -> nombreMaterialSeleccionado = $nombre;
        $this -> stock_disponible = $stock;
        $this -> searchMaterial = '';
    }

    public function seleccionarCortador(int $id, string $nombre)
    {
        $this -> form -> user_id = $id;

        $this -> nombreCortadorSeleccionado = $nombre;

        $this -> searchCortador = '';
    }

    public function quitarSeleccionCortador()
    {
        $this -> form -> user_id = null;

        $this -> nombreCortadorSeleccionado = '';

        $this-> searchCortador = '';
    }

        public function quitarSeleccionMaterial()
    {
        $this -> form -> stock_material_id = null;

        $this -> nombreMaterialSeleccionado = '';

        $this -> stock_disponible = 0;

        $this-> searchMaterial = '';
    }

    public function save(AsignacionesService $service)
    {
        $this -> form -> estado = 'Pendiente';

        if ($this->form->dm_iniciales > 0 && $this->form->consumo_estimado > 0) {

            $this->form->cortes_estimados = floor($this->form->dm_iniciales / $this->form->consumo_estimado);

        } else {

            $this->form->cortes_estimados = 0;

        }

        $this -> form -> validate();

        $data = [
            'user_id' => $this -> form -> user_id,
            'stock_material_id' => $this -> form -> stock_material_id,
            'cortes_estimados' => $this -> form -> cortes_estimados,
            'consumo_estimado' => $this -> form -> consumo_estimado,
            'dm_iniciales' => $this -> form -> dm_iniciales,
            'estado' => $this -> form -> estado,

            'rendimiento_real' => 0,
            'cortes_reales' => 0,
            'dm_sobrantes' => 0,
            'dm_adicionales' => 0
        ];

        try {

            $service -> guardarAsignacion($data);
            session() -> flash('mensaje', 'Asignación registrada con éxito!');
            $this -> form -> reset();
            return $this -> redirectRoute('asignaciones.index');

        } catch (\Exception $e) {
            report($e);
            session() -> flash('error', 'Ocurrio un problema al guardar la asignación');
        }
    }

    public function render(AsignacionesService $service)
    {
        $materiales = [];
        $cortadores = [];

        $materiales = $service -> buscarSeleccionarMaterial($this -> searchMaterial);
        $cortadores = $service -> buscarSeleccionarCortador($this -> searchCortador);

        return view('livewire.admin.asignaciones.crear-asignacion', [
            'materiales' => $materiales,
            'cortadores' => $cortadores
        ])->layout('layouts.app');
    }
}
