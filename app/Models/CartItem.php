<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    protected $fillable = [
        'user_id',        // nullable si el usuario no está logueado
        'producto_id',
        'variante_id',    // nullable para productos sin variante
        'cantidad',
        'precio',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function variante()
    {
        return $this->belongsTo(ProductoVariante::class);
    }
}