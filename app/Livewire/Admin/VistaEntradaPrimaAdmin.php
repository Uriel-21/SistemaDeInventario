<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\EntradaMateriaPrimaService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\EntradasExport;
use Maatwebsite\Excel\Facades\Excel;


class VistaEntradaPrimaAdmin extends Component
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

    public function exportarPdf(EntradaMateriaPrimaService $service)
    {
        $entradas = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);
        $pdf = Pdf::loadView('pdf.reporte-entradas', ['entradas' => $entradas]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_entradas_' . date('Y-m-d') . '.pdf');
    }

    public function exportarExcel(EntradaMateriaPrimaService $service)
    {
        $entradas = $service->obtenerParaExportar($this->search, $this->filtroTiempo);

        return Excel::download(
            new EntradasExport($entradas),
            'Reporte_Entradas_' . date('Y-m-d') . '.xlsx'
        );
    }

    public function render(EntradaMateriaPrimaService $service)
    {
        $entradas = $service -> obtenerRegistrosEntradas($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.vista-entrada-prima-admin', [
            'entradas' => $entradas
        ])->layout('layouts.app');
    }
}
