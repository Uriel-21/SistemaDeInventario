<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;

class LoteEmpaquetado extends Form
{
    #[Locked]
    public ?int $loteId = null;

    public ?int $producto_id = null;
    public ?int $user_id = null;
    public ?string $estado = null;
    public ?int $cantidad = null;

    public function rules() : array
    {
        return [
            'producto_id' => ['required', 'integer'],
            'user_id' => ['required', 'integer'],
            'estado' => ['required', 'string'],
            'cantidad' => ['required', 'integer']
        ];
    }

}
