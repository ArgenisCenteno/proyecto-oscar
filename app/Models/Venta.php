<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $fillable = [
        'tipo', 'estado', 'user_id', 'subtotal', 'descuento', 'total',
        'entregado', 'total_bs', 'moneda', 'tasa'
    ];

    // Relación con el cliente
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación con los detalles de venta
    public function detalles()
    {
        return $this->hasMany(DetalleVenta::class);
    }

    // Relación con los pagos
    public function pagos()
    {
        return $this->hasMany(Pago::class);
    }
}
