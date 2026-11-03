<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;

class SalidaProductoTerminado extends Form
{
    public ?int $user_id = null;
    public ?string $cliente = null;
    public ?string $codigo_barras = null;

    public function rules() : array
    {
        return [
            'user_id' => ['required', 'integer'],
            'cliente' => ['string', 'required', 'max:255'],
            'codigo_barras' => ['string', 'required', 'max:13'],
        ];
    }
}
