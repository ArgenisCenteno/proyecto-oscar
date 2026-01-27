<?php

namespace App\Exports;

use App\Models\Venta;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VentasExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Venta::with('user')
            ->get()
            ->map(function ($venta) {
                return [
                    'ID' => $venta->id,
                    'Cliente' => $venta->user?->name,
                    'Tipo' => $venta->tipo,
                    'Estado' => $venta->estado,
                    'Subtotal' => $venta->subtotal,
                    'Descuento' => $venta->descuento,
                    'Total' => $venta->total,
                    'Moneda' => $venta->moneda,
                    'Tasa' => $venta->tasa,
                    'Fecha' => $venta->created_at->format('d/m/Y'),
                ];
            });
    }

    public function headings(): array
    {
        return [
            'ID',
            'Cliente',
            'Tipo',
            'Estado',
            'Subtotal',
            'Descuento',
            'Total',
            'Moneda',
            'Tasa',
            'Fecha',
        ];
    }
}
