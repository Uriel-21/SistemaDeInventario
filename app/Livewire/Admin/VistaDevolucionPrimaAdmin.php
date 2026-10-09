<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\DevolucionMateriaPrimaService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $pdf = Pdf::loadView('pdf.reporte-entradas', ['entradas' => $devoluciones]);
        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, 'Reporte_devoluciones_' . date('Y-m-d') . '.pdf');
    }

    public function exportarExcel(DevolucionMateriaPrimaService $service)
    {
                $devoluciones = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);

        return response() -> streamDownload(function () use ($devoluciones) {
            $archivo = fopen('php://output', 'w');
            fputs($archivo, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($archivo, ['Material', 'Cantidad (dm)', 'Proveedor', 'Registrado por', 'Fecha y hora']);
            foreach ($devoluciones as $devolucion) {
                fputcsv($archivo, [
                    $devolucion->materiaPrima->nombre ?? 'N/A',
                    $devolucion->cantidad_dm,
                    $devolucion->proveedor,
                    $devolucion->user->name ?? 'N/A',
                    $devolucion->created_at->format('d/m/Y H:i')
                ]);
            }
            fclose($archivo);
        }, 'Reporte_devoluciones_' . date('Y-m-d') . '.csv');
    }

    public function render(DevolucionMateriaPrimaService $service)
    {
        $devoluciones = $service -> obtenerRegistrosDevoluciones($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.vista-devolucion-prima-admin', [
            'devoluciones' => $devoluciones
        ])->layout('layouts.app');
    }
}
