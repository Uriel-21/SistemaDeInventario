<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\DashboardService;

class DashboardAdmin extends Component
{
    public function mount()
    {
        $user = auth()->user();

        if($user -> hasRole('Cortador')) {
            return redirect() -> route('vistacortador');
        }

        if($user -> hasRole('Impresion')) {
            return redirect() -> route('etiquetasPendientes');
        }

        if($user -> hasRole('Empaquetador')) {
            return redirect() -> route('historiallotes');
        }
    }

    public function render(DashboardService $service)
    {
        $totalPiezas = $service -> obtenerTotalDePiezas();
        $modelosActivos = $service -> obtenerModelosActivos();
        $cortesDelDia = $service -> obtenerCortesDelDia();
        $tallasMasSolicitadas = $service -> obtenerTallasMasSolicitadas();

        return view('livewire.admin.dashboard-admin', [
            'totalPiezas' => $totalPiezas,
            'modelosActivos' => $modelosActivos,
            'cortesDelDia' => $cortesDelDia,
            'tallasMasSolicitadas'=> $tallasMasSolicitadas,
            ])->layout('layouts.app');
    }
}
