<?php

namespace App\Services;
use App\Models\AjustesInventario;
use App\Models\StockMateriaPrima;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class AjusteInventarioServices
{
    // Funcion para buscar los materiales y seleccionarlos
    public function BuscarSeleccionar(string $filtro)
    {
        return StockMateriaPrima::query()
            -> when($filtro, function ($query, $filtro) {
                $query -> PorDato($filtro);
                })
            -> latest()
            -> take(5)
            -> get();
    }

    // Funcion para guardar el ajuste de inventario
    public function guardarAjuste(array $data)
    {
        try {

            return DB::transaction(function () use ($data) {

                $ajusteInventario = AjustesInventario::create([
                    'user_id' => $data['user_id'],
                    'stock_materia_prima_id' => $data['materiaPrimaId'],
                    'cantidad_dm' => $data['cantidad_dm'],
                    'motivo' => $data['motivo'],
                    'tipo_ajuste' => $data['tipo_ajuste']
                ]);

                $materiaPrima = StockMateriaPrima::findOrFail($data['materiaPrimaId']);

                // Validacion para que la disminucion no exceda el stock real del inventario
                if($data['tipo_ajuste'] === 'disminuir' && $materiaPrima -> stock_real_dm < $data ['cantidad_dm']) {
                    throw new \Exception('El stock actual es insuficiente para realizar esta disminución.');
                }

                // Decision para saber si es aumento o disminucion
                match ($data['tipo_ajuste']) {
                    'aumentar' => $materiaPrima -> increment('stock_real_dm', $data['cantidad_dm']),
                    'disminuir' => $materiaPrima -> decrement('stock_real_dm', $data['cantidad_dm']),
                };

                return $ajusteInventario;
            });

        } catch (\Exception $e) {
            Log::error('Ocurrio un error al guardar el ajuste de inventario: ' . $e -> getMessage());
            throw $e;
        }
    }

    // Funcion para hacer consultas aplicando los filtros
    private function construirConsultaFiltros(string $busqueda = '', string $filtroTiempo = '')
    {
        return AjustesInventario::query()
            ->with(['materiaPrima', 'user'])
            ->when($busqueda, function ($query, $busqueda) {
                $query->PorDato($busqueda);
            })
            ->when($filtroTiempo === 'dia', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($filtroTiempo === 'semana', function ($query) {
                $query->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($filtroTiempo === 'mes', function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                      ->whereYear('created_at', Carbon::now()->year);
            });
    }

    // Funcion para obtener todos los datos de los ajustes de inventario
    public function obtenerRegistrosAjustes(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->paginate(10);
    }

    // Funcion para obtener los datos para exportarlos
    public function obtenerParaExportar(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->get();
    }

    // Funcion para obtener todos los datos para el modal
    public function obtenerDetalleAjusteInventario(int $id)
    {
        return AjustesInventario::with([
            'user',
            'materiaPrima'
        ])
        ->find($id);
    }
}
