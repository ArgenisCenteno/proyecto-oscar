<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UsuariosSeeder extends Seeder
{
    public function run(): void
    {
        // Crear roles si no existen
        $roles = ['SUPERADMIN', 'EMPLEADO', 'CLIENTE'];
        foreach ($roles as $rol) {
            Role::firstOrCreate(['name' => $rol]);
        }

        // Crear usuarios
        $usuarios = [
            [
                'name' => 'OSCAR IBARRA',
                'email' => 'oscar.ibarra@gmail.com',
                'password' => Hash::make('12345678'),
                'rol' => 'SUPERADMIN'
            ],
            [
                'name' => 'SALOME',
                'email' => 'salome@example.com',
                'password' => Hash::make('12345678'),
                'rol' => 'EMPLEADO'
            ],
            [
                'name' => 'HERMENEGILDO',
                'email' => 'hermenegildo@example.com',
                'password' => Hash::make('12345678'),
                'rol' => 'CLIENTE'
            ],
        ];

        foreach ($usuarios as $usuario) {
            $user = User::firstOrCreate(
                ['email' => $usuario['email']],
                [
                    'name' => $usuario['name'],
                    'password' => $usuario['password']
                ]
            );

            $user->syncRoles($usuario['rol']);
        }

        $this->command->info('Usuarios y roles creados correctamente.');
    }
}
