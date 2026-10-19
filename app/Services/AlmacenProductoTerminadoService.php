<?php

namespace App\Services;
use App\Models\AlmacenProductosTerminados;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class AlmacenProductoTerminadoService
{
    // Funcion para guardar un nuevo modelo
    public function guardarModelo(array $data)
    {
        try {

            return DB::transaction(function () use ($data) {

                $modeloProductoTerminado = AlmacenProductosTerminados::create($data);
                return $modeloProductoTerminado;

            });

        } catch (\Exception $e) {
            Log::error('Ocurrio un error al guardar el registro del modelo de producto terminado: ' . $e->getMessage());
            throw $e;
        }
    }

    // Funcion para obtener todos los registros del almacen de producto terminado
    public function obtenerDatosAlmacenProductoTerminado(string $filtro = '')
    {
        return AlmacenProductosTerminados::query()
            -> when($filtro, function ($query, $filtro) {
                $query -> PorDato($filtro);
            })
            ->latest()
            ->paginate(10);
    }

    // Funcion para modificar los registros del producto terminado
    public function modificarModelo(int $id, array $newData)
    {
        $productoTerminado = AlmacenProductosTerminados::findOrFail($id);

        try {
            DB::transaction(function () use ($newData, $productoTerminado) {
                $dataUpdate = [
                    'codigo' => $newData['codigo'] ?? $productoTerminado -> codigo,
                    'nombre_modelo' => $newData['nombre_modelo'] ?? $productoTerminado -> nombre_modelo,
                    'talla' => $newData['talla'] ?? $productoTerminado -> talla,
                    'stock_minimo' => $newData['stock_minimo'] ?? $productoTerminado -> stock_minimo,
                ];

                $productoTerminado -> update($dataUpdate);
                return $productoTerminado;
            });
        } catch (\Exception $e) {

            Log::error('Error al actualizar el modelo: ' . $e -> getMessage());
            throw $e;

        }
    }

    // Funcion para obtener informacion por ID
    public function obtenerInformacionPorId(int $id)
    {
        return AlmacenProductosTerminados::findOrFail($id);
    }

    // Funcion para obtener la informacion para llenar el formulario
    public function obtenerDatrosEdicion(int $id) : array
    {
        return $this -> obtenerInformacionPorId($id) -> only(['id', 'codigo', 'nombre_modelo', 'talla', 'stock_minimo', 'stock_minimo']);
    }

    // Funcion para borrar o desactivar el registro
    public function desactivarRegistro(int $id)
    {
        try {

            $productoTerminado = AlmacenProductosTerminados::findOrFail($id);
            $productoTerminado -> delete();

            return $productoTerminado;

        } catch (\Exception $e) {

            Log::error('Error al borrar el registro: ' . $e->getMessage());
            throw $e;

        }
    }
}
