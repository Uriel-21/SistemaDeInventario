<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\LotesEmpaquetadosService;
use Livewire\WithPagination;

class HistorialLotesAdmin extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this -> resetPage();
    }

    public function render(LotesEmpaquetadosService $service)
    {
        $lotes = $service -> obtenerRegistrosLotes($this -> search);

        return view('livewire.admin.historial-lotes-admin', [
            'lotes' => $lotes
        ])->layout('layouts.app');
    }
}
