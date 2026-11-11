<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use ReturnTypeWillChange;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasRoles;

    /** @use HasFactory<UserFactory> */
    use HasFactory;

    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'telefono',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    // Funcion para obtener usuarios por algun dato
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
                    $sub->where('name', 'LIKE', $like)
                        ->orWhere('email', 'LIKE', $like)
                        ->orWhere('telefono', 'LIKE', $like)

                        ->orWhereHas('roles', function (Builder $qRol) use ($like) {
                            $qRol->where('name', 'LIKE', $like);
                        });
                });
            }
        });
    }

    // Funcion para obtener usuarios si estan activos
    public function scopeUsuariosActivos($query)
    {
        return $query->where('isActive', true);
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

    public function asignacion() : HasOne
    {
        return $this -> hasOne(AsignacionesMaterial::class);
    }

    public function lotesEmpaquetados() : HasMany
    {
        return $this -> hasMany(lotes_empaquetados::class);
    }

    public function salidasProductos() : HasMany
    {
        return $this -> hasMany(SalidasProductosTerminados::class);
    }

    public function ajusteAlmacen() : HasMany
    {
        return $this -> hasMany(AjusteInventarioProductoTerminado::class);
    }
}
