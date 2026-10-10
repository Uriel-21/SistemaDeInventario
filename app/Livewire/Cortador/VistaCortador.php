<?php

namespace App\Livewire\Cortador;

use Livewire\Component;

class VistaCortador extends Component
{
    public function render()
    {
        return view('livewire.cortador.vista-cortador')->layout("layouts.app");
    }
}
