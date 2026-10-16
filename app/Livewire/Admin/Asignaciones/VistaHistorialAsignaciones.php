<?php

namespace App\Livewire\Admin\Asignaciones;

use Livewire\Component;
use App\Services\AsignacionesService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

class VistaHistorialAsignaciones extends Component
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

    public function exportarPdf(AsignacionesService $service)
    {
        $asignaciones = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);
        $pdf = Pdf::loadView('pdf.reporte-historial-asignaciones', ['asignaciones' => $asignaciones]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_historial-asignaciones' . date('Y-m-d') . '.pdf');
    }

    public function render(AsignacionesService $service)
    {
        $asignaciones = $service -> obtenerRegistrosAsignaciones($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.asignaciones.vista-historial-asignaciones', [
            'asignaciones' => $asignaciones
        ])->layout('layouts.app');
    }
}
