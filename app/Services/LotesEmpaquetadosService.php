<?php

namespace App\Services;
use Illuminate\Support\Facades\Log;
use App\Models\AlmacenProductosTerminados;
use App\Models\cola_impresiones;
use App\Models\lotes_empaquetados;
use Illuminate\Support\Facades\DB;

class LotesEmpaquetadosService
{
    // Funcion para buscar y seleccionar
    public function buscarSeleccionar(string $filtro)
    {
        return AlmacenProductosTerminados::query()
            -> when($filtro, function ($query, $filtro) {
                $query -> PorDato($filtro);
            })
            -> latest()
            -> take(5)
            -> get();
    }

    // Funcion para guardar lote
    public function guardarLoteConEtiqueta(array $data)
    {
        try {

            return DB::transaction(function () use ($data) {

                $codigoBarras = $this -> generarCodigoDeBarras();

                $lote = lotes_empaquetados::create([
                    'producto_id' => $data['producto_id'],
                    'user_id' => $data['user_id'],
                    'codigo_barras' => $codigoBarras,
                    'estado' => $data['estado'],
                    'cantidad' => $data['cantidad'],
                ]);

                cola_impresiones::create([
                    'lote_id' => $lote -> id,
                    'impreso' => false
                ]);

                return $lote;

            });

        } catch (\Exception $e) {
            Log::error('Error al guardar el lote: ' . $e -> getMessage());
            throw $e;
        }
    }

    // Funcion para generar el codigo de barras
    private function generarCodigoDeBarras()
    {
        do {
            $codigoBarras = '100' . date('ymd') . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
            $existe = lotes_empaquetados::where('codigo_barras', $codigoBarras)->exists();
        } while ($existe);

        return $codigoBarras;
    }

    // Funcion para obtener todos los lotes registrados
    public function obtenerRegistrosLotes(string $busqueda)
    {
        return lotes_empaquetados::query()
            -> with('productos')
            -> when($busqueda, function ($query, $busqueda) {
                $query -> PorDato($busqueda);
            })
            -> latest()
            -> paginate(10);
    }
}
