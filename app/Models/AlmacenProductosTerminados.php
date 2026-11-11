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

        if ($dato === '') {
            return $query;
        }

        $palabras = array_filter(explode(' ', $dato));

        return $query->where(function (Builder $q) use ($palabras) {
            foreach ($palabras as $palabra) {
                $like = '%' . addcslashes($palabra, '%_\\') . '%';

                // Cada palabra debe existir en al menos una de las columnas
                $q->where(function (Builder $sub) use ($like) {
                    $sub->where('codigo', 'LIKE', $like)
                        ->orWhere('nombre_modelo', 'LIKE', $like)
                        ->orWhere('talla', 'LIKE', $like);
                });
            }
        });
    }

    public function lotesEmpaquetados() : HasMany
    {
        return $this -> hasMany(lotes_empaquetados::class);
    }

    public function salidasProductos() : HasMany
    {
        return $this -> hasMany(SalidasProductosTerminados::class);
    }
}
