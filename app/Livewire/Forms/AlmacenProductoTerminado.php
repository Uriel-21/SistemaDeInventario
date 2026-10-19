<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;

class AlmacenProductoTerminado extends Form
{
    #[Locked]
    public ?int $productoTerminadoId = null;

    public ?string $codigo = null;
    public ?string $nombre_modelo = null;
    public ?string $talla = null;
    public ?float $stock_minimo = null;

    public function cargar(array $datos) : void
    {
        $this -> productoTerminadoId = $datos['id'];
        $this -> codigo = $datos['codigo'];
        $this -> nombre_modelo = $datos['nombre_modelo'];
        $this -> talla = $datos['talla'];
        $this -> stock_minimo = $datos['stock_minimo'];
    }

    public function rules() : array
    {
        return [
            'codigo' => ['required', 'string', 'min:2', 'max:100'],
            'nombre_modelo' => ['required', 'string', 'min:2', 'max:100'],
            'talla' => ['required', 'string', 'max:15'],
            'stock_minimo' => ['required', 'numeric']
        ];
    }

}
