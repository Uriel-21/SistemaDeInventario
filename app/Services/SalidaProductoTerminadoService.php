<?php

namespace App\Services;
use App\Models\AlmacenProductosTerminados;
use App\Models\lotes_empaquetados;
use App\Models\SalidasProductosTerminados;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SalidaProductoTerminadoService
{
    // Funcion para guardar una nueva salida
    public function guardarSalida(array $data)
    {
        try {

            $lote = $this -> obtenerLoteValidado($data['codigo_barras']);

            $this -> ejecutarTransaccionSalida($data, $lote);

        } catch (\Exception $e) {

            Log::error('Error al procesar la salida del inventarioL: ' . $e->getMessage(), [
                'codigo_barras' => $data['codigo_barras'],
                'user_id' => $data['user_id'] ?? 'Desconocido'
            ]);

            throw $e;
        }
    }

    // Funcion para validar y hacer la busqueda
    private function obtenerLoteValidado(string $codigoBarras)
    {
        $lote = lotes_empaquetados::where('codigo_barras', $codigoBarras) -> first();

        if (!$lote) {
            throw new Exception('No se encontró ningún lote con ese código de barras');
        }

        if ($lote -> estado === 'Vendido') {
            throw new Exception('Error ese lote ya tiene una salida registrada');
        }

        return $lote;
    }

    // Funcion para ejecutar la transaccion
    public function ejecutarTransaccionSalida(array $data, lotes_empaquetados $lote)
    {
        DB::transaction(function () use ($data, $lote) {

                SalidasProductosTerminados::create([
                    'producto_id' => $lote -> producto_id,
                    'user_id' => $data['user_id'],
                    'lote_id' => $lote -> id,
                    'cliente' => $data['cliente']
                ]);

                $lote -> update(['estado' => 'Vendido']);
                AlmacenProductosTerminados::where('id', $lote->producto_id)
                    -> decrement('stock_total', $lote -> cantidad);

        });
    }

    // Funcion para hacer consultas, utilizando los filtros
    private function construirConsultaFiltros(string $busqueda = '', string $filtroTiempo = '')
    {
        return SalidasProductosTerminados::query()
            ->with(['producto', 'user', 'lote' ])
            ->when($busqueda, function ($query, $busqueda) {
                $query->porDato($busqueda);
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

    // Funcion para obtener los registros de las salidas de los productos
    public function obtenerRegistrosSalidas(string $busqueda = '', string $filtroTiempo = '')
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
}
