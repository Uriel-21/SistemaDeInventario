<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class EntradaMateriaPrima extends Model
{

    protected $fillable = [
        'user_id',
        'stock_materia_prima_id',
        'cantidad_dm',
        'proveedor',
        'observaciones',
    ];

    public function materiaPrima() : BelongsTo
    {
        return $this -> belongsTo(StockMateriaPrima::class, 'stock_materia_prima_id')->withTrashed();
    }

    public function fotos() : HasMany
    {
        return $this -> hasMany(fotos_entradas::class, 'entrada_id');
    }

    public function user() : BelongsTo
    {
        return $this -> belongsTo(User::class);
    }

    public function scopePorDato(Builder $query, ?string $dato) : Builder
    {
        $dato = trim((string) $dato);

        return $query->when($dato !== '', function (Builder $q) use ($dato) {
            $like = '%' . addcslashes($dato, '%_\\') . '%';

            $q->where(function(Builder $sub) use ($like) {
                // Búsqueda directa en la misma tabla
                $sub->where('proveedor', 'LIKE', $like)
                    ->orWhere('created_at', 'LIKE', $like)

                    // Busqueda por la tabla de material
                    ->orWhereHas('materiaPrima', function (Builder $qMaterial) use ($like) {
                        $qMaterial->where('nombre', 'LIKE', $like);
                    })

                    // Buscar registros mediante la tabla de usuarios
                    ->orWhereHas('user', function (Builder $qUser) use ($like) {
                        $qUser->where('name', 'LIKE', $like);
                    });
            });
        });
    }
}
