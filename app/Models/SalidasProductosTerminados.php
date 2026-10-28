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

        return $query->when($dato !== '', function (Builder $q) use ($dato) {
            $like = '%' . addcslashes($dato, '%_\\') . '%';

            $q->where(function(Builder $sub) use ($like) {

                $sub->where('cliente', 'LIKE', $like)

                    ->orWhereHas('producto', function(Builder $relacion) use ($like) {
                        $relacion->where('codigo', 'LIKE', $like)
                                ->orWhere('nombre_modelo', 'LIKE', $like)
                                ->orWhere('talla', 'LIKE', $like);
                    })
                    ->orWhereHas('lote', function(Builder $relacion) use ($like) {
                        $relacion->where('codigo_barras', 'LIKE', $like);
                    });
                });
            });
    }
}
