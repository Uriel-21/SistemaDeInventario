<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use SebastianBergmann\CodeCoverage\Data\ProcessedFunctionCoverageData;
use Illuminate\Database\Eloquent\Builder;

class AjusteInventarioProductoTerminado extends Model
{
    protected $fillable = [
        'lote_id',
        'user_id',
        'cantidad',
        'tipo_ajuste',
        'motivo',
    ];

    public function user() : BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id') -> withTrashed();
    }

    public function lote() : BelongsTo
    {
        return $this -> belongsTo(lotes_empaquetados::class, 'lote_id');
    }

    public function scopePorDato(Builder $query, ?string $busqueda): Builder
    {
        $busqueda = trim((string) $busqueda);

        if (empty($busqueda)) {
            return $query;
        }

        $palabras = array_filter(explode(' ', $busqueda));

        return $query->where(function (Builder $q) use ($palabras) {
            foreach ($palabras as $palabra) {
                $like = '%' . addcslashes($palabra, '%_\\') . '%';

                $q->where(function (Builder $sub) use ($like) {
                    $sub->where('motivo', 'like', $like)
                        ->orWhere('tipo_ajuste', 'like', $like)

                        ->orWhereHas('lote', function (Builder $qLote) use ($like) {
                            $qLote->where('codigo_barras', 'like', $like)
                                ->orWhereHas('productos', function (Builder $qProducto) use ($like) {
                                    $qProducto->where('nombre_modelo', 'like', $like)
                                            ->orWhere('talla', 'like', $like)
                                            ->orWhere('codigo', 'like', $like);
                                });
                        })

                        ->orWhereHas('user', function (Builder $qUser) use ($like) {
                            $qUser->where('name', 'like', $like);
                        });
                });
            }
        });
    }
}
