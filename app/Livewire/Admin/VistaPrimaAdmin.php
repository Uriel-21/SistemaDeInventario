<?php

namespace App\Livewire\Admin;

use Livewire\Component;

class VistaPrimaAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.vista-prima-admin')->layout('layouts.app');
    }
}
