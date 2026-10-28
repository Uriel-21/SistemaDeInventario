<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\WithPagination;
use App\Services\SalidaProductoTerminadoService;
use Barryvdh\DomPDF\Facade\Pdf;

class HistorialSalidasAdmin extends Component
{
    use WithPagination;

    public $search = '';
    public $filtroTiempo = '';

    public function updatingSearch()
    {
        $this -> resetPage();
    }

    public function setFiltroTiempo(string $filtro)
    {
        if ($this -> filtroTiempo === $filtro) {
            $this -> filtroTiempo = '';
        } else {
            $this -> filtroTiempo = $filtro;
        }
        $this -> resetPage();
    }

    public function exportarPdf(SalidaProductoTerminadoService $service)
    {
        $salidas = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);
        $pdf = Pdf::loadView('pdf.reporte-historial-salidas', ['salidas' => $salidas]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_historial_salidas_de_producto_' . date('Y-m-d') . '.pdf');
    }

    public function render(SalidaProductoTerminadoService $service)
    {
        $salidas = $service -> obtenerRegistrosSalidas($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.historial-salidas-admin', [
            'salidas' => $salidas
        ])->layout('layouts.app');
    }
}
