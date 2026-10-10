<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;


class AjusteInventario extends Form
{
    #[Locked]
    public ?int $ajusteId = null;

    public int $materiaPrimaId = 0;
    public float $cantidad_dm = 0;
    public string $motivo = '';
    public string $tipo_ajuste = '';

    public function rules() : array
    {
        return [
            'materiaPrimaId' => ['integer', 'required'],
            'cantidad_dm' => ['numeric'],
            'motivo' => ['string', 'min:2', 'max:255', 'required'],
            'tipo_ajuste' => [
                'string',
                'required',
                Rule::in(['aumentar', 'disminuir'])]
        ];
    }
}
