<?php

namespace App\Services;

use App\Models\AjusteInventarioProductoTerminado;
use App\Models\AjusteInventarioProductoTerminado as ModelsAjusteInventarioProductoTerminado;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\lotes_empaquetados;
use Carbon\Carbon;
use Exception;
use InvalidArgumentException;

class AjusteInventarioProductoTerminadoService
{
    // Funcion para guardar el ajuste de almacen o inventario
    public function guardarAjuste(array $data)
    {
        try {

            $loteId = $this -> obtenerLoteValidadoId($data['codigo_barras']);
            $this-> ejecutarTransaccion($data, $loteId);

        } catch (\Exception $e) {

            Log::error('Error al procesar el ajuste de inventario: ' . $e->getMessage());
            throw $e;
        }
    }

    // Funcion para obtener el lote empaquetado
    public function obtenerLoteValidadoId(string $codigoBarras)
    {
        $codigoLimpio = trim($codigoBarras);

        if(empty($codigoLimpio)) {
            throw new InvalidArgumentException('El código de barras no puede estar vacio');
        }

        $lote = lotes_empaquetados::where('codigo_barras', $codigoLimpio)->first();

        if(!$lote) {
            throw new InvalidArgumentException("El código de barras '{$codigoLimpio}' no existe o no corresponde a ningún lote registrado.");
        }

        if ($lote -> estado === 'Vendido') {
            throw new InvalidArgumentException('Error ese lote ya tiene una salida registrada');
        }

        return $lote -> id;
    }

    // Transaccion para hacer todo el proceso
    public function ejecutarTransaccion(array $data, int $lote_id)
    {
        DB::transaction(function () use ($data, $lote_id) {

            $lote = lotes_empaquetados::lockForUpdate()->findOrFail($lote_id);
            $almacenGeneral = $lote->productos()->lockForUpdate()->first();

            if($data['tipo_ajuste'] === 'disminuir' && $lote -> cantidad < $data['cantidad']) {
                throw new InvalidArgumentException("Stock insuficiente en el lote. Stock actual: {$lote->cantidad}, Intento de salida: {$data['cantidad']}.");
            }

            AjusteInventarioProductoTerminado::create([
                'lote_id' => $lote -> id,
                'user_id' => $data['user_id'],
                'cantidad' => $data['cantidad'],
                'tipo_ajuste' => $data['tipo_ajuste'],
                'motivo' => $data['motivo']
            ]);

            // Decision para saber si es aumento o disminucion
            if ($data['tipo_ajuste'] === 'aumentar') {
                $lote->increment('cantidad', $data['cantidad']);
                $almacenGeneral?->increment('stock_total', $data['cantidad']);
            } elseif ($data['tipo_ajuste'] === 'disminuir') {
                $lote->decrement('cantidad', $data['cantidad']);
                $almacenGeneral?->decrement('stock_total', $data['cantidad']);
            }
        });
    }

    // Funcion para hacewr consultas aplicando filtros
    private function construirConsultaFiltros(string $busqueda = '', string $filtroTiempo = '')
    {
        return AjusteInventarioProductoTerminado::query()
            ->with(['lote.productos', 'user'])
            ->when($busqueda, function ($query, $busqueda) {
                $query->porDato($busqueda);
            })
            ->when($filtroTiempo === 'dia', function ($query) {
                $query->whereDate('created_at', Carbon::today());
            })
            ->when($filtroTiempo === 'semana', function ($query) {
                $query->whereBetween('created_at', [
                    Carbon::now()->startOfWeek(),
                    Carbon::now()->endOfWeek()
                ]);
            })
            ->when($filtroTiempo === 'mes', function ($query) {
                $query->whereMonth('created_at', Carbon::now()->month)
                    ->whereYear('created_at', Carbon::now()->year);
        });
    }

    // Funcion para obtener todos los datos de los ajustes de inventario de producto terminado
    public function obtenerRegistrosAjustes(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->paginate(10);
    }

    // Funcion para obtener todos los datos para el modal
    public function obtenerDetalleAjusteInventario(int $id)
    {
        return AjusteInventarioProductoTerminado::with([
            'user',
            'lote.productos'
        ])
        ->find($id);
    }

    // Funcion para obtener los datos para exportarlos
    public function obtenerParaExportar(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->get();
    }

}
