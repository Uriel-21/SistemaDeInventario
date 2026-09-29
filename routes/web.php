<?php

use App\Livewire\Admin\CrearusuariosAdmin;
use App\Livewire\Admin\DashboardAdmin;
use App\Livewire\Admin\ModificarusuariosAdmin;
use App\Livewire\Admin\VistausuariosAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', DashboardAdmin::class)->name('dashboard');
Route::get('/usuarios', VistausuariosAdmin::class)->name('usuarios');
Route::get('/crearusuarios', CrearusuariosAdmin::class)->name('crearusuarios');
Route::get('/modificarusuarios', ModificarusuariosAdmin::class)->name('modificarusuarios');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
});