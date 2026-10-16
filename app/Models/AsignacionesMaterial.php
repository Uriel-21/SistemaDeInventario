<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AsignacionesMaterial extends Model
{
    protected $fillable = [
        'user_id',
        'stock_material_id',
        'cortes_estimados',
        'consumo_estimado',
        'dm_iniciales',
        'dm_sobrantes',
        'dm_adicionales',
        'rendimiento_real',
        'cortes_reales',
        'estado',
    ];

    public function user() : BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function materiaPrima() : BelongsTo
    {
        return $this -> belongsTo(StockMateriaPrima::class, 'stock_material_id')->withTrashed();
    }

    public function scopePorDato($query, $busqueda)
    {
        return $query->where(function ($q) use ($busqueda) {
            $q->whereHas('user', function ($qUser) use ($busqueda) {
                $qUser->where('name', 'like', '%' . $busqueda . '%');
            })
            ->orWhereHas('materiaPrima', function ($qMaterial) use ($busqueda) {
                $qMaterial->where('nombre', 'like', '%' . $busqueda . '%');
            });
        });
    }

}
