<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class cola_impresiones extends Model
{
    protected $fillable = [
        'lote_id',
        'impreso'
    ];

    public function loteEmpaquetado() : BelongsTo
    {
        return $this -> belongsTo(lotes_empaquetados::class, 'lote_id');
    }
}
