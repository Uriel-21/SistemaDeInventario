<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\DevolucionMateriaPrimaService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\DevolucionesExport;
use Maatwebsite\Excel\Facades\Excel;

class VistaDevolucionPrimaAdmin extends Component
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

    public function exportarPdf(DevolucionMateriaPrimaService $service)
    {
        $devoluciones = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);
        $pdf = Pdf::loadView('pdf.reporte-devoluciones', ['devoluciones' => $devoluciones]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_devoluciones_' . date('Y-m-d') . '.pdf');
    }

    public function exportarExcel(DevolucionMateriaPrimaService $service)
    {
        $devoluciones = $service->obtenerParaExportar($this->search, $this->filtroTiempo);

        return Excel::download(
            new DevolucionesExport($devoluciones),
            'Reporte_Devoluciones_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function render(DevolucionMateriaPrimaService $service)
    {
        $devoluciones = $service -> obtenerRegistrosDevoluciones($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.vista-devolucion-prima-admin', [
            'devoluciones' => $devoluciones
        ])->layout('layouts.app');
    }
}
