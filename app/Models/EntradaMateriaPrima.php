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
                    $sub->where('proveedor', 'LIKE', $like)
                        ->orWhere('created_at', 'LIKE', $like)

                        ->orWhereHas('materiaPrima', function (Builder $qMaterial) use ($like) {
                            $qMaterial->where('nombre', 'LIKE', $like);
                        })

                        ->orWhereHas('user', function (Builder $qUser) use ($like) {
                            $qUser->where('name', 'LIKE', $like);
                        });
                });
            }
        });
    }
}
