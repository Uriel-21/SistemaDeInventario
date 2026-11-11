<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Builder;

class SalidasProductosTerminados extends Model
{
    protected $fillable = [
        'producto_id',
        'user_id',
        'lote_id',
        'cliente',
    ];

    public function producto() : BelongsTo
    {
        return $this -> belongsTo(AlmacenProductosTerminados::class, 'producto_id');
    }

    public function user() : BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id');
    }

    public function lote() : BelongsTo
    {
        return $this -> belongsTo(lotes_empaquetados::class, 'lote_id');
    }

    public function scopePorDato(Builder $query, ?string $dato): Builder
    {
        $dato = trim((string) $dato);

        if ($dato === '') {
            return $query;
        }

        $palabras = array_filter(explode(' ', $dato));

        return $query->where(function (Builder $q) use ($palabras) {
            foreach ($palabras as $palabra) {
                $like = '%' . addcslashes($palabra, '%_\\') . '%';

                $q->where(function (Builder $sub) use ($like) {
                    $sub->where('cliente', 'LIKE', $like)
                        ->orWhereHas('producto', function (Builder $relacion) use ($like) {
                            $relacion->where('codigo', 'LIKE', $like)
                                    ->orWhere('nombre_modelo', 'LIKE', $like)
                                    ->orWhere('talla', 'LIKE', $like);
                        })
                        ->orWhereHas('lote', function (Builder $relacion) use ($like) {
                            $relacion->where('codigo_barras', 'LIKE', $like);
                        });
                });
            }
        });
    }
}
