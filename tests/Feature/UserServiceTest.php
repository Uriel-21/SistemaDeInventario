<?php

namespace Tests\Feature;

use app\Models\User;
use Tests\TestCase;
use App\Services\UserService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Log;

class UserServiceTest extends TestCase
{
    use RefreshDatabase;

    public function testParaGuardarUsuarios()
    {
        $datosSimulados = [
            'name' => 'Uriel',
            'email' => 'uriel@gmail.com',
            'password' => bcrypt('password1234'),
            'telefono' => '1234567890',
        ];

        $servicio = new UserService();

        $usuarioCreado = $servicio -> guardarUsuario($datosSimulados);

        $this -> assertInstanceOf(User::class, $usuarioCreado);

        $this -> assertEquals('Uriel', $usuarioCreado->name);

        $this -> assertDatabaseHas('users', [
            'email' => 'uriel@gmail.com',
            'telefono' => '1234567890'
        ]);
    }

    public function testParaActivarExcepcion()
    {
        Log::shouldReceive('error')
            ->once()
                -> withArgs(function($mensaje){
                    return str_contains($mensaje, 'Error al registrar el usuario');
                });
        $this -> expectException(\Exception::class);

        $servicio = new UserService();

        $datosInvalidos = [
            'email' => 'correo_invalido@gmail.com'
        ];

        $servicio -> guardarUsuario($datosInvalidos);
    }

    public function testModificarUsuario()
    {
        $usuarioOriginal = User::factory() -> create([
            'name' => 'nombre viejo',
            'telefono' => '0000000000'
        ]);

        $datosNuevos = [
            'name' => 'Usuario actualizado',
            'telefono' => '1234567890'
        ];

        $servicio = new UserService();

        $usuarioModificado = $servicio -> modificarUsuario($usuarioOriginal -> id, $datosNuevos);

        $this -> assertDatabaseHas('users', [
            'id' => $usuarioOriginal -> id,
            'name' => 'Usuario actualizado'
        ]);

        $this -> assertEquals('Usuario actualizado', $usuarioModificado -> name);
    }

    public function testActivarExcepcionAlModificar()
    {
        $this -> expectException(\Exception::class);

        $datosNuevos = [
            'name' => 'Usuario fallido',
            'telefono' => '1234567890'
        ];

        $servicio = new UserService();

        $servicio -> modificarUsuario(9999, $datosNuevos);
    }

    public function testParaBorrarUsuario()
    {
        $usuario = User::factory() -> create([
            'name' => 'Usuario',
            'telefono' => '1234567890',
            'isActive' => true
        ]);

        $servicio = new UserService();

        $usuarioBorrado = $servicio -> desactivarUsuario($usuario -> id);


        $this -> assertDatabaseHas(User::class, [
            'id' => $usuario -> id,
            'isActive' => false
        ]);

        $this -> assertFalse($usuarioBorrado -> isActive);
    }

    public function testParaActivarExcepcionBorrarUsuario()
    {
        $this -> expectException(\Exception::class);

        $servicio = new UserService();

        $servicio -> desactivarUsuario(9999);
    }

    public function testParaBuscarUsuarios()
    {
        $usuario = User::factory() -> create([
            'name' => 'Usuario Nuevo',
            'email' => 'usuario@gmail.com'
        ]);

        $otroUsuario = User::factory() -> create([
            'name' => 'Otro Usuario',
            'email' => 'otro@gmail.com'
        ]);

        $servicio = new UserService();

        $resultados = $servicio -> obtenerUsuarios('Usuario Nuevo');

        $this -> assertCount(1, $resultados);

        $this -> assertEquals($usuario -> id, $resultados -> first() -> id);
    }
}
