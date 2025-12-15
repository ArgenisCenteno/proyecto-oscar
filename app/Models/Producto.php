<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Producto extends Model
{
    protected $fillable = [
        'subcategoria_id',
        'nombre',
        'slug',
        'descripcion',
        'precio',
        'stock',
        'sku',
        'estado',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($producto) {
            if (empty($producto->slug)) {
                $producto->slug = Str::slug($producto->nombre) . '-' . uniqid();
            }
        });
    }

    public function subcategoria()
    {
        return $this->belongsTo(Subcategoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class);
    }

    public function variantes()
    {
        return $this->hasMany(ProductoVariante::class);
    }
}
