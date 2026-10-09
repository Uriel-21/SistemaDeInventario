<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Locked;


class EntradaMateriaPrima extends Form
{
    #[Locked]
    public ?int $entradaId = null;

    public int $materiaPrimaId = 0;
    public float $cantidad_dm = 0;
    public string $proveedor = '';
    public string $observaciones = '';
    public array $foto_path = [];

    public function rules() : array
    {
        return [
            'materiaPrimaId' => ['integer', 'required'],
            'cantidad_dm' => ['numeric'],
            'proveedor' => ['string', 'required ', 'min:2', 'max:100'],
            'observaciones' => ['string', 'min:2', 'max:255', 'required'],
            'foto_path' => ['nullable', 'array', 'max:5'],
            'foto_path.*' => ['image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];
    }
}
