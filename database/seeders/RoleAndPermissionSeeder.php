<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Spatie\Permission\Models\Role;

class RoleAndPermissionSeeder extends Seeder
{
    public function run(): void
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permisos del sistema
        $permisos = [
            // Usuarios
            'ver usuarios',
            'crear usuario',
            'modificar usuario',
            'eliminar usuario',
            // Almacen de materia prima
            'ver almacen de materia prima',
            'crear materia prima',
            'modificar materia prima',
            'eliminar materia prima',
            // Entrada de materia prima
            'registrar entrada de materia prima',
            'ver historial de entradas de materia prima',
            'exportar entradas de materia prima en pdf',
            'exportar entradas de materia prima en excel',
            // Devoluciones de materia prima
            'registrar devolucion de materia prima',
            'ver historial de devoluciones de materia prima',
            'exportar devoluciones de materia prima en pdf',
            'exportar devoluciones de materia prima en excel',
            // Ajuste de inventario de materia prima
            'ver ajustes de inventario de materia prima',
            'registrar un ajuste de inventario de materia prima',
            'exportar ajustes de materia prima en pdf',
            'exportar ajustes de materia prima en excel',
            // Asignaciones de material
            'registrar asignacion',
            'ver asignaciones activas',
            'terminar asignacion',
            'registrar material adicional',
            'ver historial de asignaciones',
            'exportar asignaciones a pdf',
            'exportar asignaciones a excel',
            // Este permiso va a ser para el cortador para que vea solo la información del material que se le asigno
            'ver material asignado',
            // Almacen de producto terminado
            'ver producto terminado',
            'crear nuevo modelo de producto terminado',
            'modifcar modelo de producto terminado',
            'eliminar modelo de producto terminado',
            // Lotes empaquetados (entradas de producto terminado)
            'ver lotes en almacen',
            'registrar nuevo lote',
            'exportar lotes en almacen en pdf',
            'exportar lotes en almacen en excel',
            // Salida de lotes (salida de producto)
            'ver historial de salidas de producto terminado',
            'registrar nueva salida',
            'exportar historial de salidas de producto terminado en pdf',
            'exportar historial de salidas de producto terminado en excel',
            // Ajuste de almacen de producto terminado
            'ver historial de ajustes de producto terminado',
            'registrar ajuste de producto terminado',
            'exportar historial de ajustes de producto terminado en pdf',
            'exportar historial de ajustes de producto terminado en excel',
            // Impresion de etiquetas
            'imprimir etiquetas pendientes',
        ];

        // Crear los permisos
        foreach($permisos as $permiso) {
            Permission::findOrCreate($permiso, 'web');
        }

        // Crear roles y asignar permisos

        // ROL: ADMIN
        $roleAdmin = Role::findOrCreate('Administrador', 'web');
        $roleAdmin -> givePermissionTo(Permission::all());

        // ROL: COORDINADOR
        $roleCordinador = Role::findOrCreate('Coordinador', 'web');
        $roleCordinador -> givePermissionTo([

            // Almacen de materia prima
            'ver almacen de materia prima',
            'crear materia prima',
            'modificar materia prima',
            // Entrada de materia prima
            'registrar entrada de materia prima',
            'ver historial de entradas de materia prima',
            'exportar entradas de materia prima en pdf',
            'exportar entradas de materia prima en excel',
            // Devoluciones de materia prima
            'registrar devolucion de materia prima',
            'ver historial de devoluciones de materia prima',
            'exportar devoluciones de materia prima en pdf',
            'exportar devoluciones de materia prima en excel',
            // Ajuste de inventario de materia prima
            'ver ajustes de inventario de materia prima',
            'registrar un ajuste de inventario de materia prima',
            'exportar ajustes de materia prima en pdf',
            'exportar ajustes de materia prima en excel',
            // Asignaciones de material
            'registrar asignacion',
            'ver asignaciones activas',
            'terminar asignacion',
            'registrar material adicional',
            'ver historial de asignaciones',
            'exportar asignaciones a pdf',
            'exportar asignaciones a excel',
            // Almacen de producto terminado
            'ver producto terminado',
            'crear nuevo modelo de producto terminado',
            'modifcar modelo de producto terminado',
            'eliminar modelo de producto terminado',
            // Lotes empaquetados (entradas de producto terminado)
            'ver lotes en almacen',
            'registrar nuevo lote',
            'exportar lotes en almacen en pdf',
            'exportar lotes en almacen en excel',
            // Salida de lotes (salida de producto)
            'ver historial de salidas de producto terminado',
            'registrar nueva salida',
            'exportar historial de salidas de producto terminado en pdf',
            'exportar historial de salidas de producto terminado en excel',
            // Ajuste de almacen de producto terminado
            'ver historial de ajustes de producto terminado',
            'registrar ajuste de producto terminado',
            'exportar historial de ajustes de producto terminado en pdf',
            'exportar historial de ajustes de producto terminado en excel',
        ]);

        // ROL: CORTADOR
        $roleCortador = Role::findOrCreate('Cortador', 'web');
        $roleCortador -> givePermissionTo([
            'ver material asignado'
        ]);

        // ROL: EMPAQUETADOR
        $roleEmpaquetador = Role::findOrCreate('Empaquetador', 'web');
        $roleEmpaquetador -> givePermissionTo([
            // Almacen de producto terminado
            'ver producto terminado',
            'crear nuevo modelo de producto terminado',
            'modifcar modelo de producto terminado',
            // Lotes empaquetados (entradas de producto terminado)
            'ver lotes en almacen',
            'registrar nuevo lote',
            // Salida de lotes (salida de producto)
            'ver historial de salidas de producto terminado',
            'registrar nueva salida',
        ]);

        // ROL: Impresion
        $roleImpresion = Role::findOrCreate('Impresion', 'web');
        $roleImpresion -> givePermissionTo([
            'imprimir etiquetas pendientes'
        ]);
    }
}
