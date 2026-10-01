<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Exception;
use Illuminate\Testing\Fluent\Concerns\Has;

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
                    'password' => Hash::make($datos['password']),
                    'telefono' => $datos['telefono']
            ]);
            return $usuario;

        } catch (Exception $e) {
            Log::error('Error al registrar el usuario: ' . $e->getMessage());
            throw $e;
        }
    }

    // Funcion que devuelve un arreglo para la edicion de usuarios
    public function obtenerDatos(int $id) : array
    {
        return $this -> obtenerUsuarioPorId($id) -> only(['id', 'name', 'email', 'telefono']);
    }
    // Funcion para modificar los registros de los usuarios
    public function modificarUsuario(int $id, array $newData)
    {
        $usuario = User::findOrFail($id);
        try {

            $dataUpdate = [
                'name' => $newData['name'] ?? $usuario -> name,
                'email' => $newData['email'] ?? $usuario -> email,
                'telefono' => $newData['telefono'] ?? $usuario -> telefono
            ];

            if (!empty($newData['password'])) {
                $dataUpdate['password'] = Hash::make($newData['password']);
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

    // Función para generar un password aleatorio
    public function generarPassword()
    {
        return Str::random(8);
    }

    // Funcion para obtener el usuario por medio del ID
    public function obtenerUsuarioPorId(int $id)
    {
        return User::findOrFail($id);
    }
}
