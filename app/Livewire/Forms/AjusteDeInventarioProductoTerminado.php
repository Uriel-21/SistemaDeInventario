<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;
use Illuminate\Validation\Rule;


class AjusteDeInventarioProductoTerminado extends Form
{
    #[Locked]
    public ?int $ajusteId = null;

    public int $cantidad = 0;
    public string $tipo_ajuste = '';
    public string $motivo = '';
    public string $codigo_barras = '';

    public function rules() : array
    {
        return [
            'codigo_barras' => ['string', 'required'],
            'cantidad' => ['integer', 'required', 'min:1'],
            'motivo' => ['string', 'required', 'max:255'],
            'tipo_ajuste' => [
                'string',
                'required',
                Rule::in(['aumentar', 'disminuir'])
            ]
        ];
    }
}
