<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleVenta extends Model
{
    use HasFactory;

    protected $table = 'detalles_ventas';

    protected $fillable = [
        'venta_id', 'producto_id', 'cantidad', 'precio',
        'descuento', 'subtotal', 'variantes'
    ];

    protected $casts = [
        'variantes' => 'array', // JSON a array automáticamente
    ];

    // Relación con la venta
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    // Relación con el producto
    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function variante()
    {
         return $this->belongsTo(ProductoVariante::class);
    }
}
