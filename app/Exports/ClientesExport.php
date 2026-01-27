<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ClientesExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return User::role('CLIENTE')
            ->get()
            ->map(function ($user) {
                return [
                    'ID' => $user->id,
                    'Nombre' => $user->name,
                    'Email' => $user->email,
                    'Cédula' => $user->cedula,
                    'Teléfono' => $user->telefono,
                    'Estado' => $user->bloqueado ? 'Bloqueado' : 'Activo',
                    'Registrado' => $user->created_at->format('d/m/Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Nombre',
            'Email',
            'Cédula',
            'Teléfono',
            'Estado',
            'Fecha de registro',
        ];
    }
}
