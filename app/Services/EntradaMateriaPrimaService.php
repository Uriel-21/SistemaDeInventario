<?php

namespace App\Services;
use App\Models\StockMateriaPrima;
use Exception;
use Symfony\Component\Process\ExecutableFinder;
use Illuminate\Support\Facades\DB;
use App\Models\fotos_entradas;
use App\Models\EntradaMateriaPrima;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class EntradaMateriaPrimaService
{

    // Funcion para mandar datos para la seleccion de material
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

    // Funcion para guardar entrada de materia prima
    public function guardarEntrada(array $data)
    {
        try {
            return DB::transaction(function () use ($data) {

                $entradaMateriaPrima = EntradaMateriaPrima::create([
                    'user_id' => $data['user_id'],
                    'stock_materia_prima_id' => $data['materiaPrimaId'],
                    'cantidad_dm' => $data['cantidad_dm'],
                    'proveedor' => $data['proveedor'],
                    'observaciones' => $data['observaciones'] ?? null
                ]);

                $materiaPrima = StockMateriaPrima::findOrFail($data['materiaPrimaId']);
                $materiaPrima -> increment('stock_real_dm', $data['cantidad_dm']);

                if(!empty($data['foto_path'])) {
                    foreach ($data['foto_path'] as $foto) {
                        $rutaFoto = $foto -> store('evidencias', 'public');

                        $entradaMateriaPrima->fotos()->create([
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

    private function construirConsultaFiltros(string $busqueda = '', string $filtroTiempo = '')
    {
        return EntradaMateriaPrima::query()
            ->with(['materiaPrima', 'user'])
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

    public function obtenerRegistrosEntradas(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this->construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->paginate(10);
    }

    public function obtenerParaExportar(string $busqueda = '', string $filtroTiempo = '')
    {
        return $this->construirConsultaFiltros($busqueda, $filtroTiempo)
            ->latest()
            ->get();
    }

    // Funcion para obtener todos los datos para el modal
    public function obtenerDetalleEntrada(int $id)
    {
        return EntradaMateriaPrima::with([
            'user',
            'materiaPrima',
            'fotos'
        ])
        -> find($id);
    }
}
