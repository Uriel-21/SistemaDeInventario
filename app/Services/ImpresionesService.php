<?php

namespace App\Services;
use App\Models\cola_impresiones;
use Illuminate\Support\Facades\Log;

class ImpresionesService
{
    // Funcion para obtener todas las etiquetas sin imprimir
    public function obtenerEtiquetasPendientes()
    {
        return cola_impresiones::query()
            -> with(['loteEmpaquetado.productos'])
            -> where('impreso', false)
            -> oldest()
            -> get();
    }

    public function obtenerEtiquetasParaImprimir()
    {
        return cola_impresiones::query()
            -> with(['loteEmpaquetado.productos'])
            -> where('impreso', false)
            -> oldest()
            -> take(5)
            -> get();
    }

    // Funcion para marcar las etiquetas como impresas
    public function marcarComoImpresos(array $ids)
    {
        if(empty($ids)) return 0;

        return cola_impresiones::whereIn('id', $ids)->update([
            'impreso' => true
        ]);
    }
}
