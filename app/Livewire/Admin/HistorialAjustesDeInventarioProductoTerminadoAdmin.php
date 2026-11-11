<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AjusteInventarioProductoTerminadoService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class HistorialAjustesDeInventarioProductoTerminadoAdmin extends Component
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

    public function exportarPdf(AjusteInventarioProductoTerminadoService $service)
    {
        $this -> authorize('exportar historial de ajustes de producto terminado en pdf');

        $ajustes = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);
        $pdf = Pdf::loadView('pdf.reporte-historial-ajuste-inventario-producto-terminado', ['ajustes' => $ajustes]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_ajuste_inventario_producto_terminado' . date('Y-m-d') . '.pdf');
    }

    public function render(AjusteInventarioProductoTerminadoService $service)
    {
        $ajustes = $service -> obtenerRegistrosAjustes($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.historial-ajustes-de-inventario-producto-terminado-admin', [
            'ajustes' => $ajustes
        ])->layout('layouts.app');
    }
}
