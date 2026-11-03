<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Services\ImpresionesService;
use Barryvdh\DomPDF\Facade\Pdf;
use Picqer\Barcode\BarcodeGeneratorPNG;

class EtiquetasPendientes extends Component
{

    public function imprimir(ImpresionesService $service)
    {
        $pendientes = $service -> obtenerEtiquetasParaImprimir();

        if ($pendientes -> isEmpty()) {
            session() -> flash('error', 'No hay etiquetas pendientes por imprimir');
            return;
        }

        $ids = $pendientes -> pluck('id')->toArray();
        $service -> marcarComoImpresos($ids);

        $datosLimpios = $this -> prepararDatosParaPdf($pendientes);

        $pdf = $this -> construirPdf($datosLimpios);

        $nombreArchivo = 'etiquetas_' . now()->format('Y-m-d_H-i-s') . '.pdf';

        return response() -> streamDownload(function () use ($pdf) {
            echo $pdf -> output();
        }, $nombreArchivo);
    }

    private function prepararDatosParaPdf($pendientes)
    {
        $generator = new BarcodeGeneratorPNG();
        $datosParaLaVista = [];

        foreach ($pendientes as $fila) {
            $codigoTexto = $fila -> loteEmpaquetado -> codigo_barras ?? '00000000';

            $datosParaLaVista[] = [
                'modelo' => $fila -> loteEmpaquetado -> productos -> nombre_modelo ?? 'N/D',
                'talla' => $fila -> loteEmpaquetado -> productos -> talla ?? 'N/D',
                'codigo' => $codigoTexto,
                'codigo_base64' => base64_encode($generator->getBarcode($codigoTexto, 'C128', 2, 40))
            ];
        }

        return $datosParaLaVista;
    }

    private function construirPdf(array $datosLimpios)
    {
        return Pdf::loadView('pdf.etiquetas', [
            'etiquetas' => $datosLimpios
        ]) -> setPaper([0, 0, 288, 432], 'portrait');
    }

    public function render(ImpresionesService $service)
    {
        $etiquetas = $service -> obtenerEtiquetasPendientes();

        return view('livewire.admin.etiquetas-pendientes', [
            'etiquetas' => $etiquetas
        ])->layout('layouts.app');
    }
}
