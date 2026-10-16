<?php

namespace App\Livewire\Admin\Asignaciones;

use App\Models\AsignacionesMaterial;
use Livewire\Component;
use Livewire\Attributes\On;
use App\Services\AsignacionesService;
use App\Livewire\Forms\Asignaciones;
use Livewire\Attributes\Computed;

class ModalFinalizarAsignacion extends Component
{
    public ?AsignacionesMaterial $asignacion = null;
    public Asignaciones $form;

    #[On('abrir-modal-finalizar')]
    public function cargar(int $id, AsignacionesService $service)
    {
        $this -> asignacion = $service -> obtenerInfoAsignaciones($id);

        $this -> form -> reset();

        $this -> dispatch('mostrar-modal-finalizar');
    }

    #[Computed]
    public function tareasReales()
    {
        return is_numeric($this -> form -> tareas_realizadas) ? (float) $this -> form -> tareas_realizadas : 0;
    }

    #[Computed]
    public function piezasCalculadas()
    {
        return $this -> tareasReales() * 25;
    }

    #[Computed]
    public function rendimientoVivo()
    {
        if ($this -> tareasReales <= 0 || !$this -> asignacion) {
            return 0;
        }

        $sobrante = $this -> form -> sobro_material && is_numeric($this -> form -> dm_sobrantes)
            ? (float) $this -> form -> dm_sobrantes : 0;

        $totalDisponible = $this -> asignacion -> dm_iniciales + ($this -> asignacion -> dm_adicionales ?? 0);
        $gastado = max(0, $totalDisponible - $sobrante);

        return round($gastado / $this -> tareasReales, 2);
    }

    public function save(AsignacionesService $service)
    {
        $dm_disponibles = $this -> asignacion -> dm_iniciales + ($this -> asignacion -> dm_adicionales ?? 0);

        $this->validate([
            'form.tareas_realizadas' => 'required|numeric|min:0',
            'form.dm_sobrantes' => 'nullable|numeric|min:0',
        ]);

        $tareas_reales = (float) $this -> form -> tareas_realizadas;

        $dm_sobrantes = $this -> form -> sobro_material ? (float) $this -> form -> dm_sobrantes : 0;

        $total_gastado = $dm_disponibles - $dm_sobrantes;

        $rendimiento_real = 0;

        if($tareas_reales > 0) {
            $rendimiento_real = round($total_gastado / $tareas_reales, 2);
        }

        $data = [
            'id' => $this -> asignacion -> id,
            'cortes_reales' => $tareas_reales,
            'dm_sobrantes' => $dm_sobrantes,
            'rendimiento_real' => $rendimiento_real,
            'estado' => 'Finalizado'
        ];

        try {

            $service -> finalizarAsignacion($data);

            $this -> dispatch('ocultar-modal-finalizar');
            $this -> dispatch('asignacion-actualizada');
            $this -> asignacion = null;

            session() -> flash('mensaje', 'Asignación finalizada con éxito');

        } catch (\Exception $e) {
            session() -> flash('error', 'Ocurrió un problema al finalizar la asignación');
        }
    }

    public function render()
    {
        return view('livewire.admin.asignaciones.modal-finalizar-asignacion')->layout('layouts.app');
    }
}
