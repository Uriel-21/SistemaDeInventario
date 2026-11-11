<?php

namespace App\Models;

use App\Livewire\Forms\AlmacenProductoTerminado;
use App\Services\SalidaProductoTerminadoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class lotes_empaquetados extends Model
{
    protected $fillable = [
        'producto_id',
        'user_id',
        'codigo_barras',
        'estado',
        'cantidad'
    ];

    public function users() : BelongsTo
    {
        return $this -> belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function productos() : BelongsTo
    {
        return $this -> belongsTo(AlmacenProductosTerminados::class, 'producto_id')->withTrashed();
    }

    public function salida() : HasOne
    {
        return $this -> hasOne(SalidasProductosTerminados::class, 'lote_id');
    }

    public function ajusteAlmacen() : HasMany
    {
        return $this -> hasMany(AjusteInventarioProductoTerminado::class);
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
                    $sub->where('codigo_barras', 'LIKE', $like)
                        ->orWhereHas('productos', function (Builder $relacion) use ($like) {
                            $relacion->where('codigo', 'LIKE', $like)
                                    ->orWhere('nombre_modelo', 'LIKE', $like)
                                    ->orWhere('talla', 'LIKE', $like);
                        });
                });
            }
        });
    }

}
