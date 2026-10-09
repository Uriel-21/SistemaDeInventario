<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class fotos_devoluciones extends Model
{
    protected $fillable = [
        'foto_path'
    ];

    public function devoluciones() : BelongsTo
    {
        return $this -> belongsTo(DevolucionMateriaPrima::class, 'devolucion_id');
    }
}
