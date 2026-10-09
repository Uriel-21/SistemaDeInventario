<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;

class StockMateriaPrimaForm extends Form
{
    #[Locked]
    public ?int $materiaPrimaId = null;

    public string $folio = '';
    public string $nombre = '';
    public float $stock_minimo = 0;
    public string $ubicacion = '';

    public function cargar(array $datos) : void
    {
        $this -> materiaPrimaId = $datos['id'];
        $this -> folio = $datos['folio'];
        $this -> nombre = $datos['nombre'];
        $this -> stock_minimo = $datos['stock_minimo'];
        $this -> ubicacion = $datos['ubicacion'];
    }

    public function rules() : array
    {
        return [
            'folio' => [
                'required', 'string', 'min:2', 'max:20',
                Rule::unique('stock_materia_primas', 'folio') -> ignore($this -> materiaPrimaId),
            ],
            'nombre' => ['required', 'string', 'min:2', 'max:100'],
            'stock_minimo' => ['required', 'numeric', 'min:0'],
            'ubicacion' => ['string', 'min:2', 'max:100']
        ];
    }

}
