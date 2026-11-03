<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class AlmacenProductosTerminados extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'codigo',
        'nombre_modelo',
        'talla',
        'stock_total',
        'stock_minimo',
    ];

    public function scopePorDato(Builder $query, ?string $dato): Builder
    {
        $dato = trim((string) $dato);

        return $query->when($dato !== '', function (Builder $q) use ($dato) {
            $like = '%' . addcslashes($dato, '%_\\') . '%';

            $q->where(function(Builder $sub) use ($like) {
                $sub->where('codigo', 'LIKE', $like)
                    ->orWhere('nombre_modelo', 'LIKE', $like)
                    ->orWhere('talla', 'LIKE', $like);
            });
        });
    }

    public function lotesEmpaquetados() : HasMany
    {
        return $this -> hasMany(lotes_empaquetados::class);
    }
}
