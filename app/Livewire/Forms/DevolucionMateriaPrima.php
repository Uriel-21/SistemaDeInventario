<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;

class DevolucionMateriaPrima extends Form
{
    #[Locked]
    public ?int $devolucionId = null;

    public int $materiaPrimaId = 0;
    public float $cantidad_dm = 0;
    public string $proveedor = '';
    public string $motivo = '';
    public array $foto_path = [];

    public function rules() : array
    {
        return [
            'materiaPrimaId' => ['integer', 'required'],
            'cantidad_dm' => ['numeric'],
            'proveedor' => ['string', 'required', 'min:2', 'max:100'],
            'motivo' => ['string', 'min:2', 'max:255', 'required'],
            'foto_path' => ['nullable', 'array', 'max:5'],
            'foto_path.*' => ['image',  'mimes:png,jpg,jpeg,webp', 'max:2048']
        ];
    }
}
