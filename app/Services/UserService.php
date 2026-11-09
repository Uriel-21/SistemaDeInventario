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
            -> with('roles')
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

            // Asignar el rol
            if (isset($datos['rol']) && !empty($datos['rol'])) {
                $usuario -> assignRole($datos['rol']);
            }

            return $usuario;

        } catch (Exception $e) {
            Log::error('Error al registrar el usuario: ' . $e->getMessage());
            throw $e;
        }
    }

    // Funcion que devuelve un arreglo para la edicion de usuarios
    public function obtenerDatos(int $id) : array
    {
        $usuario = $this -> obtenerUsuarioPorId($id);

        $datos = $usuario -> only([
            'id',
            'name',
            'email',
            'telefono'
        ]);
        $datos['rol'] = $usuario->roles->first()?->name ?? '';

        return $datos;
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

            // Sincronizar para actualizar el rol
            if (isset($newData['rol']) && !empty($newData['rol'])) {
                $usuario -> syncRoles($newData['rol']);
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
            $usuario -> delete();

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
