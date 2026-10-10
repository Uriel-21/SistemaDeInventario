<?php

namespace App\Services;
use App\Models\StockMateriaPrima;
use App\Models\DevolucionMateriaPrima;
use Carbon\Carbon;
use CBOR\Tag\StringReferenceNamespaceTag;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Exception;

class DevolucionMateriaPrimaService
{
    // Funcion para buscar y seleccionar el material
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

    // Funcion para guardar la devolucion de la materia prima
    public function guardarDevolucion(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {

                $devolucionMateriaPrima = DevolucionMateriaPrima::create([
                    'user_id' => $data['user_id'],
                    'stock_materia_prima_id' => $data['materiaPrimaId'],
                    'cantidad_dm' => $data['cantidad_dm'],
                    'proveedor' => $data['proveedor'],
                    'motivo' => $data['motivo'] ?? null
                ]);

                $materiaPrima = StockMateriaPrima::findOrFail($data['materiaPrimaId']);

                if($data['cantidad_dm'] > $materiaPrima -> stock_real_dm) {

                    throw new \Exception('El stock actual es insuficiente para realizar esta devolución.');
                }

                $materiaPrima -> decrement('stock_real_dm', $data['cantidad_dm']);

                if(!empty($data['foto_path'])) {
                    foreach ($data['foto_path'] as $foto) {
                        $rutaFoto = $foto -> store('evidencias/devoluciones', 'public');

                        $devolucionMateriaPrima->fotos()->create([
                            'foto_path' => $rutaFoto
                        ]);
                    }
                }
            });
        } catch (Exception $e) {
            Log::error('Ocurrio un error al guardar el registro: ' . $e->getMessage());
            throw $e;
        }
    }

    // Funcion para hacer consultas aplicando filtros desde el frontend
    private function construirConsultaFiltros(string $busqueda = '', string $filtroTiempo = '')
    {
        return DevolucionMateriaPrima::query()
            ->with(['materiaPrima', 'user'])
            ->when($busqueda, function($query, $busqueda){
                $query -> PorDato($busqueda);
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

    // Funcion para obtener todos los registros de las devoluciones
    public function obtenerRegistrosDevoluciones(string $busqueda = '', string $filtroTiempo)
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->paginate(10);
    }

    // Funcion para poder exportar en Excel y PDF
    public function obtenerParaExportar(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this -> construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->get();
    }

    // Funcion para obtener todos los datos para el modal
    public function obtenerDetallesDevolucion(int $id)
    {
        return DevolucionMateriaPrima::with([
            'user',
            'materiaPrima',
            'fotos'
        ])
        -> find($id);
    }
}
