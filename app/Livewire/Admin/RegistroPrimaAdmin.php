<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\MateriaPrimaService;
use App\Livewire\Forms\StockMateriaPrimaForm;

class RegistroPrimaAdmin extends Component
{

    public StockMateriaPrimaForm $form;


    public function save(MateriaPrimaService $service)
    {
        $this -> form -> validate();

        $data = [
            'folio' => $this -> form -> folio,
            'nombre' => $this -> form -> nombre,
            'stock_minimo' => $this -> form -> stock_minimo,
            'ubicacion' => $this -> form -> ubicacion
        ];

        try {

            $service -> guardarMateriaPrima($data);
            session() -> flash('mensaje', 'Materia prima registrada con exito!');
            $this -> form -> reset();

        } catch (\Exception $e) {
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
        return view('livewire.admin.registro-prima-admin')->layout('layouts.app');
    }
}
