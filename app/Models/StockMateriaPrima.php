<?php

namespace App\Models;

use Hamcrest\Xml\HasXPath;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StockMateriaPrima extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'folio',
        'nombre',
        'stock_minimo',
        'ubicacion',
    ];

    public function scopePorDato(Builder $query, ?string $dato) : Builder
    {
        $dato = trim((string) $dato);

        return $query -> when($dato !== '', function (Builder $q) use ($dato) {
            $like = '%' . addcslashes($dato, '%_\\') . '%';

            $q -> where(function(Builder $sub) use ($like) {
                $sub -> where('folio', 'LIKE', $like)
                        ->orWhere('nombre', 'LIKE', $like);
            });
        });
    }

    public function scopeActivos(Builder $query) : Builder
    {
        return $query -> where ('isActive', true);
    }

    public function entradas() : HasMany
    {
        return $this -> hasMany(EntradaMateriaPrima::class);
    }

    public function devoluciones() : HasMany
    {
        return $this -> hasMany(DevolucionMateriaPrima::class);
    }

    public function ajustes() : HasMany
    {
        return $this -> hasMany(AjustesInventario::class);
    }
}
