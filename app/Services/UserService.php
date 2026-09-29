<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Exception;

class UserService
{

    // Funcion para obtener usuarios activos y por filtro
    public function obtenerUsuarios(string $filtro = '')
    {
        return User::query()
            -> usuariosActivos()
            -> when($filtro, function ($query, $filtro) {
                $query -> PorDato($filtro);
            })
            -> paginate(10);
    }

    // Funcion para guardar los usuarios
    public function guardarUsuario(array $datos)
    {
        try {
                $usuario = User::create([
                    'name' => $datos['name'],
                    'email' => $datos['email'],
                    'password' => $datos['password'],
                    'telefono' => $datos['telefono']
            ]);
            return $usuario;

        } catch (Exception $e) {
            Log::error('Error al registrar el usuario: ' . $e->getMessage());
            throw $e;
        }
    }

    // Funcion para modificar los registros de los usuarios
    public function modificarUsuario(int $id, array $newData)
    {
        try {

            $usuario = User::findOrFail($id);

            $dataUpdate = [
                'name' => $newData['name'] ?? $usuario -> name,
                'email' => $newData['email'] ?? $usuario -> email,
                'telefono' => $newData['telefono'] ?? $usuario -> telefono
            ];

            if (!empty($newData['password'])) {
                $dataUpdate['password'] = $newData = ['password'];
            }

            $usuario -> update($dataUpdate);

            return $usuario;

        } catch (\Exception $e) {
            Log::error('Error al actualizar el usuario: ' . $e -> getMessage());

            throw $e;
        }
    }

    // Funcion para borrar o desactivar un usuario
    public function desactivarUsuario(int $id)
    {
        try {

            $usuario = User::findOrFail($id);

            $usuario -> isActive = false;
            $usuario -> save();

            return $usuario;

        } catch (\Exception $e) {
            Log::error('Error al desactivar usuario ID ' . $id .$e -> getMessage());

            throw $e;
        }
    }
}
