<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subcategoria extends Model
{
    use HasFactory;

    protected $fillable = ['categoria_id', 'nombre', 'descripcion', 'imagen'];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }
}
