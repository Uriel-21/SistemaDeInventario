<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\LotesEmpaquetadosService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class HistorialLotesAdmin extends Component
{
    use WithPagination;

    public $search = '';

    public function updatingSearch()
    {
        $this -> resetPage();
    }

    public function exportarPdf(LotesEmpaquetadosService $service)
    {
        $lotes = $service -> obtenerParaExportar($this -> search);
        $pdf = Pdf::loadView('pdf.reporte-lotes-en-almacen', ['lotes' => $lotes]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_lotes_en_almacen' . date('Y-m-d') . '.pdf');
    }

    public function render(LotesEmpaquetadosService $service)
    {
        $lotes = $service -> obtenerRegistrosLotes($this -> search);

        return view('livewire.admin.historial-lotes-admin', [
            'lotes' => $lotes
        ])->layout('layouts.app');
    }
}
