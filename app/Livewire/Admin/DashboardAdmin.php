<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class DashboardAdmin extends Component
{
    public function mount()
    {
        $user = auth() -> user();

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

    public function render()
    {
        return view('livewire.admin.dashboard-admin')->layout('layouts.app');
    }
}
