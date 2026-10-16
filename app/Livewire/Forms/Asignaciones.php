<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;
use Livewire\Attributes\Locked;
use Livewire\Attributes\Rule;

class Asignaciones extends Form
{
    #[Locked]
    public ?int $asignacionId = null;

    public ?int $user_id = 0;
    public ?int $stock_material_id = 0;
    public ?float $cortes_estimados = null;
    public $consumo_estimado = null;
    public $dm_iniciales = null;
    public $dm_sobrantes = null;
    public ?float $dm_adicionales = null;
    public ?float $rendimiento_real = null;
    public ?float $cortes_reales = null;
    public ?string $estado = null;
    public $sobro_material = false;
    public $tareas_realizadas = 0;

    public function rules() : array
    {
        return [
            'user_id' => ['integer', 'required'],
            'stock_material_id' => ['integer', 'required'],
            'cortes_estimados' => ['numeric', 'required'],
            'consumo_estimado' => ['numeric', 'required'],
            'dm_iniciales' => ['numeric', 'required'],
            'dm_sobrantes' => ['numeric', 'nullable'],
            'dm_adicionales' => ['numeric', 'nullable'],
            'rendimiento_real' => ['numeric', 'nullable'],
            'cortes_reales' => ['numeric', 'nullable'],
            'estado' => ['string', 'required'],
            'tareas_realizadas' => ['required', 'numeric', 'min:0']
        ];
    }
}
