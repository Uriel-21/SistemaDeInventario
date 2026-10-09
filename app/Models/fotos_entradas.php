<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class fotos_entradas extends Model
{
    protected $fillable = [
        'foto_path'
    ];

    public function entradas() : BelongsTo
    {
        return $this -> belongsTo(EntradaMateriaPrima::class, 'entrada_id');
    }
}
