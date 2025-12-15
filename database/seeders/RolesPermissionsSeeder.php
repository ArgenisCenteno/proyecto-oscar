<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Limpiar cache de permisos
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Permisos
        $permissions = [
            // Dashboard
            'view dashboard',

            // Categorías
            'view categorias', 'create categorias', 'edit categorias', 'delete categorias',

            // Subcategorías
            'view subcategorias', 'create subcategorias', 'edit subcategorias', 'delete subcategorias',

            // Productos
            'view productos', 'create productos', 'edit productos', 'delete productos',

            // Promociones
            'view promociones', 'create promociones', 'edit promociones', 'delete promociones',

            // Cupones
            'view cupones', 'create cupones', 'edit cupones', 'delete cupones',

            // Ventas
            'view ventas', 'create ventas', 'edit ventas', 'delete ventas',

            // Pagos
            'view pagos', 'create pagos', 'edit pagos', 'delete pagos',

            // Usuarios
            'view usuarios', 'create usuarios', 'edit usuarios', 'delete usuarios',

            // Roles & Permisos
            'view roles', 'create roles', 'edit roles', 'delete roles',
            'view permisos', 'create permisos', 'edit permisos', 'delete permisos',

            // Reportes
            'view reportes',

            // Auditoría
            'view auditoria',
        ];

        // Crear permisos
        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // Crear roles
        $roles = [
            'SUPERADMIN' => Permission::all(), // Todo
            'EMPLEADO' => Permission::whereIn('name', [
                'view dashboard',
                'view categorias', 'view subcategorias',
                'view productos', 'view promociones', 'view cupones',
                'view ventas', 'view pagos',
                'view reportes',
            ])->get(),
            'CLIENTE' => Permission::whereIn('name', [
                'view dashboard',
               
                'create ventas','view ventas',
                  'create pagos','view pagos',
            ])->get(),
        ];

        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::firstOrCreate(['name' => $roleName]);
            $role->syncPermissions($rolePermissions);
        }

        $this->command->info('Roles y permisos creados correctamente!');
    }
}
