<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class AgregarLoteAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.agregar-lote-admin')->layout('layouts.app');
    }
}
