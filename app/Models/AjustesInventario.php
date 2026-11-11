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

    public function scopePorDato(Builder $query, ?string $busqueda): Builder
    {
        $busqueda = trim((string) $busqueda);

        if ($busqueda === '') {
            return $query;
        }

        // Tokenizar la búsqueda en palabras independientes
        $palabras = array_filter(explode(' ', $busqueda));

        return $query->where(function (Builder $q) use ($palabras) {
            foreach ($palabras as $palabra) {
                $like = '%' . addcslashes($palabra, '%_\\') . '%';

                // Cada palabra debe coincidir en el motivo o en la materia prima
                $q->where(function (Builder $sub) use ($like) {
                    $sub->where('motivo', 'like', $like)
                        ->orWhereHas('materiaPrima', function (Builder $qMaterial) use ($like) {
                            $qMaterial->where('nombre', 'like', $like);
                        });
                });
            }
        });
    }

}
