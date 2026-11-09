<?php

use App\Livewire\Admin\AgregarLoteAdmin;
use App\Livewire\Admin\AgregarNuevoModeloAdmin;
use App\Livewire\Admin\AjusteInventarioAdmin;
use App\Livewire\Admin\CrearusuariosAdmin;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\DevolucionPrimaAdmin;
use App\Livewire\Admin\EntradaPrimaAdmin;
use App\Livewire\Admin\FinalizarAsignacionAdmin;
use App\Livewire\Admin\HistorialLotesAdmin;
use App\Livewire\Admin\HistorialSalidasAdmin;
use App\Livewire\Admin\MaterialAdicionalAdmin;
use App\Livewire\Admin\ModificarModeloAdmin;
use App\Livewire\Admin\ModificarPrimaAdmin;
use App\Livewire\Admin\ModificarusuariosAdmin;
use App\Livewire\Admin\RegistrarSalidaAdmin;
use App\Livewire\Admin\RegistroPrimaAdmin;
use App\Livewire\Admin\SeleccionarCortadorAdmin;
use App\Livewire\Admin\SeleccionarMaterialAdmin;
use App\Livewire\Admin\VistaAjusteInventarioAdmin;
use App\Livewire\Admin\VistaAsignacionesAdmin;
use App\Livewire\Admin\VistaDevolucionPrimaAdmin;
use App\Livewire\Admin\VistaEntradaPrimaAdmin;
use App\Livewire\Admin\VistaHistorialAsignacionesAdmin;
use App\Livewire\Admin\VistaPrimaAdmin;
use App\Livewire\Admin\VistaProductoTerminadoAdmin;
use App\Livewire\Admin\VistausuariosAdmin;
use App\Livewire\Cortador\VistaCortador;
use Illuminate\Support\Facades\Route;
use App\Livewire\Admin\Asignaciones\AsignacionesIndex;
use App\Livewire\Admin\Asignaciones\VistaHistorialAsignaciones;
use App\Livewire\Admin\EtiquetasPendientes;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');

    // Usuarios
    Route::get('/usuarios', VistausuariosAdmin::class)->middleware('can:ver usuarios')->name('usuarios');
    Route::get('/usuarios/{id}/edit', ModificarusuariosAdmin::class)-> middleware('can:modificar usuario')-> name ('EditarUsuario');
    Route::get('/crearusuarios', CrearusuariosAdmin::class)->middleware('can:crear usuario')->name('crearusuarios');
    // ---------------------------------------------------------------------------------------------------------------------------------

    // Materia prima
    Route::get('/materiaprima', VistaPrimaAdmin::class)-> middleware('can:ver almacen de materia prima')-> name('materiaprima');
    Route::get('/registroprima', RegistroPrimaAdmin::class)-> middleware('can:crear materia prima')-> name('registroprima');
    Route::get('materiaprima/{id}/edit', ModificarPrimaAdmin::class)-> middleware('can:modificar materia prima') -> name('EditarMateriaPrima');
    // -----------------------------------------------------------------------------------------------------------

    // Entrada de materia prima
    Route::get('/entradaprima', EntradaPrimaAdmin::class)-> middleware('can:registrar entrada de materia prima') -> name('entradaprima');
    Route::get('/consultaprima', VistaEntradaPrimaAdmin::class)-> middleware('can:ver historial de entradas de materia prima') -> name('consultaprima');
    // ------------------------------------------------------------------------------------------

    // Devolucion de materia prima
    Route::get('/devolucionprima', DevolucionPrimaAdmin::class)-> middleware('can:registrar devolucion de materia prima') -> name('devolucionprima');
    Route::get('/vistadevolucionprima', VistaDevolucionPrimaAdmin::class)-> middleware('can:ver historial de devoluciones de materia prima') -> name('vistadevolucionprima');
    // ---------------------------------------------------------------------------------------------------

    // Ajuste de inventario de materia prima
    Route::get('/ajusteinventario', AjusteInventarioAdmin::class)-> middleware('can:registrar un ajuste de inventario de materia prima') -> name('ajusteinventario');
    Route::get('/vistaajusteinventario', VistaAjusteInventarioAdmin::class)-> middleware('can:ver ajustes de inventario de materia prima') -> name('vistaajusteinventario');
    // --------------------------------------------------------------------------------------------------------

    // Asignaciones de material
    Route::get('/asignaciones', AsignacionesIndex::class)-> middleware('can:ver asignaciones activas')-> name('asignaciones.index');
    Route::get('/historial-asignaciones', VistaHistorialAsignaciones::class)-> middleware('can:ver historial de asignaciones')-> name('asignaciones.historial');
    // -------------------------------------------------------------------------------------------------------------------------

    // Cortador
    Route::get('/vistacortador', VistaCortador::class)-> middleware('can:ver material asignado') -> name('vistacortador');
    // -----------------------------------------------------------------------------

    // Almacen de producto terminado
    Route::get('/productoterminado', VistaProductoTerminadoAdmin::class)-> middleware('can:ver producto terminado')-> name('productoterminado');
    Route::get('/agregarmodelo', AgregarNuevoModeloAdmin::class)-> middleware('can:crear nuevo modelo de producto terminado')-> name('agregarmodelo');
    Route::get('/productoTerminado/{id}/edit', ModificarModeloAdmin::class)-> middleware('can:modifcar modelo de producto terminado')-> name('modelo.edit');

    // Lotes empaquetados (entradas de producto terminado)
    Route::get('/historiallotes', HistorialLotesAdmin::class)-> middleware('can:ver lotes en almacen')-> name('historiallotes');
    Route::get('/agregarlote', AgregarLoteAdmin::class)-> middleware('can:registrar nuevo lote')-> name('agregarlote');

    // Salidas de lotes (salida de producto)
    Route::get('/historialsalidas', HistorialSalidasAdmin::class)-> middleware('can:ver historial de salidas de producto terminado')-> name('historialsalidas');
    Route::get('/registrarsalida', RegistrarSalidaAdmin::class)-> middleware('can:registrar nueva salida')-> name('registrarsalida');

    // Etiquetas para imprimir
    Route::get('/etiquetas_Pendientes', EtiquetasPendientes::class) -> name('etiquetasPendientes');
});



