<?php

namespace App\Services;
use App\Models\AlmacenProductosTerminados;
use App\Models\AsignacionesMaterial;
use Carbon\Carbon;

class DashboardService
{
    // Funcion para traer el total de piezas en el almacen de producto terminado
    public function obtenerTotalDePiezas()
    {
        return (int) AlmacenProductosTerminados::sum('stock_total');
    }

    // Funcion para obtener el total de modelos activos
    public function obtenerModelosActivos()
    {
        return AlmacenProductosTerminados::count();
    }

    // Funcion para obtener los cortes hechos en el dia
    public function obtenerCortesDelDia()
    {
        $inicioDia = Carbon::now() -> startOfDay();
        $finDia = Carbon::now() -> endOfDay();

        return (int) AsignacionesMaterial::where('estado', 'Finalizado')
            -> whereBetween('updated_at', [$inicioDia, $finDia])
            -> sum('cortes_reales');
    }

    // Funcion para obtener las 2 tallas más vendidas
    public function obtenerTallasMasSolicitadas(): string
    {
        $topTallas = AlmacenProductosTerminados::whereHas('salidasProductos')
            ->with('salidasProductos.lote')
            ->get()
            ->groupBy('talla')
            ->map(function ($productosDeEsaTalla) {
                return $productosDeEsaTalla->sum(function ($producto) {
                    return $producto->salidasProductos->sum(fn ($salida) => $salida->lote?->cantidad ?? 0);
                });
            })
            ->filter(fn ($totalPares) => $totalPares > 0)
            ->sortDesc()
            ->take(2)
            ->keys();

        if ($topTallas->isEmpty()) {
            return 'Sin ventas';
        }

        return 'Talla ' . $topTallas->implode(' / ');
    }

}

