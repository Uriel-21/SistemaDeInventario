<?php

namespace App\Livewire\Admin\Asignaciones;

use Livewire\Component;
use App\Livewire\Forms\Asignaciones;
use App\Services\AsignacionesService;
use Livewire\Attributes\On;

class ModalMateriaAdicional extends Component
{
    public Asignaciones $form;

    public $asignacion = null;

    #[On('abrir-modal-adicional')]
    public function catgarAsignacion(int $id, AsignacionesService $service)
    {
        $this -> resetValidation();
        $this -> form -> reset();
        $this -> asignacion = $service -> obtenerInfoAsignaciones($id);
        $this -> dispatch('mostrar-modal-adicional');
    }

    public function save(AsignacionesService $service)
    {
        $stock_disponible = $this -> asignacion -> materiaPrima -> stock_real_dm ?? 0;

        $this -> validate([
            'form.dm_adicionales' => "required|numeric|min:0.01|max:{$stock_disponible}",
        ]);

        $data = [
            'id' => $this -> asignacion -> id,
            'dm_adicionales' => (float) $this -> form -> dm_adicionales
        ];

        try {

            $service -> materialAdicional($data);

            $this -> dispatch('ocultar-modal-adicional');
            $this -> dispatch('asignacion-actualizada');

            $this -> asignacion = null;
            $this -> form -> reset();

            session() -> flash('mensaje', 'Material adicional asignado con éxito');

        } catch (\Exception $e) {
            session() -> flash('error', $e -> getMessage());
            throw $e;
        }
    }

    public function render()
    {
        return view('livewire.admin.asignaciones.modal-materia-adicional');
    }
}
