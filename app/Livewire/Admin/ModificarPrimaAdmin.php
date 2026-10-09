<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\MateriaPrimaService;
use App\Livewire\Forms\StockMateriaPrimaForm;
use Exception;
use Symfony\Component\Process\ExecutableFinder;

class ModificarPrimaAdmin extends Component
{
    public StockMateriaPrimaForm $form;
    protected MateriaPrimaService $service;

    public function boot(MateriaPrimaService $service) : void
    {
        $this -> service = $service;
    }

    public function mount(int $id) : void
    {
        $this -> form -> cargar($this -> service -> obtenerDatosEdicion($id));
    }

    public function save()
    {
        $datos = $this -> form -> validate();

        try {

            $this -> service -> modificarMateriaPrima($this -> form -> materiaPrimaId, $datos);
            session() -> flash('mensaje', 'Materia prima actualizada correctamente');
            return redirect() -> route('materiaprima');

        } catch (Exception $e) {
            report($e);
            session() -> flash('error', 'Ocurrio un problema la guardar la materia prima');
        }
    }

    public function cancelarRegresar()
    {
        $this -> reset();
        $this -> resetValidation();
        return $this -> redirectRoute('materiaprima');
    }

    public function render()
    {
        return view('livewire.admin.modificar-prima-admin')->layout('layouts.app');
    }
}
