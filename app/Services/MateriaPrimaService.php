<?php

namespace App\Services;
use App\Models\StockMateriaPrima;
use Exception;
use Illuminate\Foundation\Console\StorageLinkCommand;
use Illuminate\Support\Facades\Log;

class MateriaPrimaService
{
    // Funcion para guardar materia prima
    public function guardarMateriaPrima(array $data)
    {
        try {

            $materiaPrima = StockMateriaPrima::create([
                'folio' => $data['folio'],
                'nombre' => $data['nombre'],
                'stock_minimo' => $data['stock_minimo'],
                'ubicacion' => $data['ubicacion'],
            ]);

            return $materiaPrima;

        } catch (Exception $e) {
            Log::error("Error al registrar la materia prima", $e -> getMessage());
            throw $e;
        }
    }

    // Funcion para obtener todos los registro de la materia prima
    public function obtenerDatosMateriaPrima(string $filtro = '')
    {
        return StockMateriaPrima::query()
            -> Activos()
            -> when($filtro, function ($query, $filtro) {
                $query -> PorDato($filtro);
            })
            -> latest()
            -> paginate(10);
    }

    // Funcion para modificar la materia prima
    public function modificarMateriaPrima(int $id, array $newData)
    {
        $materiaPrima = StockMateriaPrima::findorFail($id);

        try {
            $dataUpdate = [
                'folio' => $newData['folio'] ?? $materiaPrima -> folio,
                'nombre' => $newData['nombre'] ?? $materiaPrima -> nombre,
                'stock_minimo' => $newData['stock_minimo'] ?? $materiaPrima -> stock_minimo,
                'ubicacion' => $newData['ubicacion'] ?? $materiaPrima -> ubicacion
            ];

            $materiaPrima -> update($dataUpdate);
            return $materiaPrima;


        } catch (Exception $e) {
            Log::error("Error al modificar la materia prima", $e -> getMessage());
            throw $e;
        }
    }

    // Funcion para obtener materia prima por ID
    public function obtenerInformacionPorId(int $id)
    {
        return StockMateriaPrima::findOrFail($id);
    }

    // Funcion para obtener los datos para la edicion
    public function obtenerDatosEdicion(int $id) : array
    {
        return $this -> obtenerInformacionPorId($id) -> only(['id', 'folio', 'nombre', 'stock_minimo', 'ubicacion']);
    }

    // Funcion para eliminar o desactivar el registro
    public function desactivarRegistro(int $id)
    {
        try {

            $materiaPrima = StockMateriaPrima::findOrFail($id);
            $materiaPrima -> isActive = false;
            $materiaPrima -> save();

            return $materiaPrima;

        } catch (Exception $e) {
            Log::error('Error al desactivar el registro, ID: ' . $id . $e -> getMessage());

            throw $e;
        }
    }
}
