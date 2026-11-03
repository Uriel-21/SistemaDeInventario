<?php

namespace App\Models;

use App\Livewire\Forms\AlmacenProductoTerminado;
use App\Services\SalidaProductoTerminadoService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;
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


    public function scopePorDato(Builder $query, ?string $dato): Builder
    {
        $dato = trim((string) $dato);

        return $query->when($dato !== '', function (Builder $q) use ($dato) {
            $like = '%' . addcslashes($dato, '%_\\') . '%';

            $q->where(function(Builder $sub) use ($like) {

                $sub->where('codigo_barras', 'LIKE', $like)

                    ->orWhereHas('productos', function(Builder $relacion) use ($like) {
                        $relacion->where('codigo', 'LIKE', $like)
                                ->orWhere('nombre_modelo', 'LIKE', $like)
                                ->orWhere('talla', 'LIKE', $like);
                    });
                });
            });
    }

}
