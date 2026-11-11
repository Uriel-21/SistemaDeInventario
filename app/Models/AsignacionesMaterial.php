<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
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

    public function scopePorDato(Builder $query, ?string $busqueda): Builder
    {
        $busqueda = trim((string) $busqueda);

        if ($busqueda === '') {
            return $query;
        }

        $palabras = array_filter(explode(' ', $busqueda));

        return $query->where(function (Builder $q) use ($palabras) {
            foreach ($palabras as $palabra) {
                $like = '%' . addcslashes($palabra, '%_\\') . '%';

                $q->where(function (Builder $sub) use ($like) {
                    $sub->whereHas('user', function (Builder $qUser) use ($like) {
                        $qUser->where('name', 'like', $like);
                    })
                    ->orWhereHas('materiaPrima', function (Builder $qMaterial) use ($like) {
                        $qMaterial->where('nombre', 'like', $like);
                    });
                });
            }
        });
    }

}
