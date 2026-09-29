<?php

namespace App\Livewire\Layouts;

use Livewire\Component;

class Header extends Component
{
    public string $title;
    public string $subtitle;

    public function mount(string $title = 'Panel', string $subtitle = 'Gestión del sistema')
    {
        $this -> title = $title;
        $this -> subtitle = $subtitle;
    }

    public function render()
    {
        return view('livewire.layouts.header') -> layout('layouts.app');
    }
}
