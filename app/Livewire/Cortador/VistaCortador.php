<?php

namespace App\Livewire\Cortador;

use Livewire\Component;
use App\Services\AsignacionesService;
use Livewire\Attributes\Computed;
use Illuminate\Support\Facades\Auth;

class VistaCortador extends Component
{

    #[Computed]
    public function asignacion()
    {
        $service = app(AsignacionesService::class);
        return $service -> obtenerAsignacionActivaPorCortador(Auth::id());
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();

        return redirect('/');
    }

    public function render()
    {
        return view('livewire.cortador.vista-cortador')->layout("layouts.app");
    }
}
