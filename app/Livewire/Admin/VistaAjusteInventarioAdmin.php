<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\AjusteInventarioServices;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\AjustesExport;
use Maatwebsite\Excel\Facades\Excel;

class VistaAjusteInventarioAdmin extends Component
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

    public function exportarPdf(AjusteInventarioServices $service)
    {
        $ajustes = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);
        $pdf = Pdf::loadView('pdf.reporte-ajuste', ['ajustes' => $ajustes]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_ajuste_inventario_' . date('Y-m-d') . '.pdf');
    }

    public function exportarExcel(AjusteInventarioServices $service)
    {
        $ajustes = $service->obtenerParaExportar($this->search, $this->filtroTiempo);

        return Excel::download(
            new AjustesExport($ajustes),
            'Reporte_Ajuste_inventario_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function render(AjusteInventarioServices $service)
    {
        $ajustes = $service -> obtenerRegistrosAjustes($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.vista-ajuste-inventario-admin', [
            'ajustes' => $ajustes
        ])->layout('layouts.app');
    }
}
