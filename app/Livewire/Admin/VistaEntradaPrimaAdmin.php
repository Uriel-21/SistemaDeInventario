<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\EntradaMateriaPrimaService;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;


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
        $entradas = $service -> obtenerParaExportar($this -> search, $this -> filtroTiempo);

        return response() -> streamDownload(function () use ($entradas) {
            $archivo = fopen('php://output', 'w');
            fputs($archivo, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($archivo, ['Material', 'Cantidad (dm)', 'Proveedor', 'Registrado por', 'Fecha y hora']);
            foreach ($entradas as $entrada) {
                fputcsv($archivo, [
                    $entrada->materiaPrima->nombre ?? 'N/A',
                    $entrada->cantidad_dm,
                    $entrada->proveedor,
                    $entrada->user->name ?? 'N/A',
                    $entrada->created_at->format('d/m/Y H:i')
                ]);
            }
            fclose($archivo);
        }, 'Reporte_entradas_' . date('Y-m-d') . '.csv');
    }

    public function render(EntradaMateriaPrimaService $service)
    {
        $entradas = $service -> obtenerRegistrosEntradas($this -> search, $this -> filtroTiempo);

        return view('livewire.admin.vista-entrada-prima-admin', [
            'entradas' => $entradas
        ])->layout('layouts.app');
    }
}
