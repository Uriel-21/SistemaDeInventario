<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class AjustesInventario extends Model
{
    protected $fillable = [
        'user_id',
        'stock_materia_prima_id',
        'cantidad_dm',
        'motivo',
        'tipo_ajuste'
    ];

    public function materiaPrima() : BelongsTo
    {
        return $this -> belongsTo(StockMateriaPrima::class, 'stock_materia_prima_id');
    }

    public function user() : BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function scopePorDato($query, $busqueda)
    {
        return $query->where(function ($q) use ($busqueda) {
            $q->where('motivo', 'like', '%' . $busqueda . '%')
            ->orWhereHas('materiaPrima', function ($qMaterial) use ($busqueda) {
                $qMaterial->where('nombre', 'like', '%' . $busqueda . '%');
            });
        });
    }

}
