<?php

use App\Livewire\Admin\AjusteInventarioAdmin;
use App\Livewire\Admin\CrearusuariosAdmin;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\DetallesEntradaPrimaAdmin;
use App\Livewire\Admin\DevolucionPrimaAdmin;
use App\Livewire\Admin\EntradaPrimaAdmin;
use App\Livewire\Admin\ModificarPrimaAdmin;
use App\Livewire\Admin\ModificarusuariosAdmin;
use App\Livewire\Admin\RegistroPrimaAdmin;
use App\Livewire\Admin\VistaAjusteInventarioAdmin;
use App\Livewire\Admin\VistaDevolucionPrimaAdmin;
use App\Livewire\Admin\VistaEntradaPrimaAdmin;
use App\Livewire\Admin\VistaPrimaAdmin;
use App\Livewire\Admin\VistausuariosAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');
Route::get('/usuarios', VistausuariosAdmin::class)->name('usuarios');
Route::get('/crearusuarios', CrearusuariosAdmin::class)->name('crearusuarios');
Route::get('/modificarusuarios', ModificarusuariosAdmin::class)->name('modificarusuarios');
Route::get('/materiaprima', VistaPrimaAdmin::class)->name('materiaprima');
Route::get('/registroprima', RegistroPrimaAdmin::class)->name('registroprima');
Route::get('/entradaprima', EntradaPrimaAdmin::class)->name('entradaprima');
Route::get('/devolucionprima', DevolucionPrimaAdmin::class)->name('devolucionprima');
Route::get('/ajusteinventario', AjusteInventarioAdmin::class)->name('ajusteinventario');
Route::get('/modificarprima', ModificarPrimaAdmin::class)->name('modificarprima');
Route::get('/consultaprima', VistaEntradaPrimaAdmin::class)->name('consultaprima');
Route::get('/vistadevolucionprima', VistaDevolucionPrimaAdmin::class)->name('vistadevolucionprima');
Route::get('/vistaajusteinventario', VistaAjusteInventarioAdmin::class)->name('vistaajusteinventario');


Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
});


// Ruta para modificar el usuario
Route::get('/usuarios/{id}/edit', ModificarusuariosAdmin::class) -> name ('EditarUsuario');

// Ruta para modificar la materia prima
Route::get('materiaprima/{id}/edit', ModificarPrimaAdmin::class) -> name('EditarMateriaPrima');
