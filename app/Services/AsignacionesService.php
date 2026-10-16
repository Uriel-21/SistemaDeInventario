<?php

namespace App\Services;
use App\Models\AsignacionesMaterial;
use App\Models\StockMateriaPrima;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class AsignacionesService
{
    // Funcion para buscar y seleccionar el cortador
    public function buscarSeleccionarCortador(string $filtro)
    {
        return User::query()
            // ->role ('cortador')
            ->when($filtro, function ($query, $filtro) {
                $query -> porDato($filtro);
            })
            ->take(5)
            ->get();
    }

    // Funcion para buscar y seleccionar
    public function buscarSeleccionarMaterial(string $filtro)
    {
        return StockMateriaPrima::query()
            ->when($filtro, function ($query, $filtro) {
                $query -> porDato($filtro);
            })
            ->take(5)
            ->get();
    }

    // Funcion para guardar una nueva asignacion
    public function guardarAsignacion(array $data)
    {
        try {

            return DB::transaction(function () use ($data) {

                // $asignaciones = AsignacionesMaterial::create([
                //     'user_id' => $data['user_id'],
                //     'stock_material_id' => $data['stock_material_id'],
                //     'cortes_estimados' => $data['cortes_estimados'],
                //     'consumo_estimado' => $data['consumo_estimado'],
                //     'dm_iniciales' => $data['dm_iniciales'],
                //     'estado' => $data['estado'],
                // ]);

                $asignaciones = AsignacionesMaterial::create($data);

                $materiaPrima = StockMateriaPrima::findOrFail($data['stock_material_id']);

                $materiaPrima -> decrement('stock_real_dm', $data['dm_iniciales']);

                return $asignaciones;
        });

        } catch (\Exception $e) {
            Log::error('Ocurrio un error al guardar la asignación: ' . $e -> getMessage());
            throw $e;
        }
    }

    // Función para obtener todas las asignaciones activas o pendientes
    public function obtenerAsignacionesPendientes()
    {
        return AsignacionesMaterial::with('user', 'materiaPrima')
            ->where('estado', 'Pendiente')
            ->latest()
            ->get();
    }

    // Funcion para obtener los datos para la finalizacion de la asignacion
    public function obtenerInfoAsignaciones(int $id)
    {
        return AsignacionesMaterial::with(['user', 'materiaPrima'])->findOrFail($id);
    }

    // Funcion para registrar la finalizacion de asignacion
    public function finalizarAsignacion(array $data)
    {
        try {

        return DB::transaction(function () use ($data) {
            $asignacion = AsignacionesMaterial::findOrFail($data['id']);

            $asignacion -> update([
                'cortes_reales' => $data['cortes_reales'],
                'dm_sobrantes' => $data['dm_sobrantes'],
                'rendimiento_real' => $data['rendimiento_real'],
                'estado' => $data['estado']
            ]);

            if($data['dm_sobrantes'] > 0) {
                $materiaPrima = $asignacion -> materiaPrima;

                if ($materiaPrima) {

                    $materiaPrima -> increment('stock_real_dm', $data['dm_sobrantes']);

                }
            }

            return $asignacion;
        });

        } catch(\Exception $e) {

            Log::error('Error al finalizar la asignación: ' . $e -> getMessage());
            throw $e;
        }
    }

    // Funcion para registrar material adicional si se necesita
    public function materialAdicional(array $data)
    {
        try {
        return DB::transaction(function () use ($data) {
            $asignacion = AsignacionesMaterial::findOrFail($data['id']);
            $materiaPrima = $asignacion -> materiaPrima;

            $dmExtra = (float) $data['dm_adicionales'];

            if (!$materiaPrima || $materiaPrima -> stock_real_dm < $dmExtra) {
                throw new \Exception('No hay suficiente stock en el almacen para entregar este material adicional');
            }

            $materiaPrima -> decrement('stock_real_dm', $dmExtra);

            $acumuladoAdicionales = ($asignacion -> dm_adicionales ?? 0) + $dmExtra;

            // Primera opcion para que no se te olvide wey
            $asignacion -> update([
                'dm_adicionales' => $acumuladoAdicionales
            ]);

            // Segunda opcion para que tampoco se te olvide wey
            // $totalDmMesa = $asignacion -> dm_iniciales + $acumuladoAdicionales;

            // $nuevosEstimados = $asignacion -> consumo_estimado > 0
            //     ? round($totalDmMesa / $asignacion -> consumo_estimado, 2)
            //     : $asignacion -> cortes_estimados;

            // $asignacion -> DB::update([
            //     'dm_adicionales' => $acumuladoAdicionales,
            //     'cortes_estimados' => $nuevosEstimados
            // ]);

            return $asignacion;
        });
        } catch (\Exception $e) {

            Log::error('Error al guardar la asignación de material adicional: ' . $e -> getMessage());
            throw $e;
        }
    }

    // Funcion para hacer consultas aplicando filtros desde el frontend
    private function construirConsultaFiltros(string $busqueda = '', string $filtroTiempo = '')
    {
        return AsignacionesMaterial::query()
            ->with(['materiaPrima', 'user'])
            ->when($busqueda, function($query, $busqueda){
                $query->PorDato($busqueda);
            })
            ->when($filtroTiempo === 'dia', function ($query) {
                // Cambiamos created_at por updated_at
                $query->whereDate('updated_at', Carbon::today());
            })
            ->when($filtroTiempo === 'semana', function ($query) {
                $query->whereBetween('updated_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()]);
            })
            ->when($filtroTiempo === 'mes', function ($query) {
                $query->whereMonth('updated_at', Carbon::now()->month)
                      ->whereYear('updated_at', Carbon::now()->year);
            })
            ->where('estado', 'Finalizado');

    }

    // Funcion para exportar ya sea Pdf o Excel
    public function obtenerParaExportar(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->get();
    }

    // Funcion para obtener todos los registros de las asignaciones
    public function obtenerRegistrosAsignaciones(string $busqueda = '', string $filtroTiempo)
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->paginate(10);
    }

    // Funcion para obtener la asignación activa del cortador
    public function obtenerAsignacionActivaPorCortador(int $id)
    {
        return AsignacionesMaterial::with('materiaPrima')
            ->where('user_id', $id)
            ->where('estado', 'Pendiente')
            ->first();
    }
}
