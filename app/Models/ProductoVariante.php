<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductoVariante extends Model
{
    protected $fillable = [
        'producto_id',
        'talla',
        'color',
        'precio',
        'stock',
        'sku'
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}
