<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Promocion extends Model
{
    protected $table = 'promociones';

    protected $fillable = [
        'nombre',
        'tipo',
        'valor',
        'minimo',
        'categoria_id',
        'subcategoria_id',
        'activo',
        'fecha_inicio',
        'fecha_fin',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'activo' => 'boolean'
    ];

    public function categoria()
    {
        return $this->belongsTo(\App\Models\Categoria::class);
    }

    public function subcategoria()
    {
        return $this->belongsTo(\App\Models\Subcategoria::class);
    }

    // Verifica si la promoción está activa
    public function estaActiva()
    {
        $hoy = Carbon::now();

        return $this->activo
            && $hoy->between($this->fecha_inicio, $this->fecha_fin);
    }

    // Aplica descuento al total
    public function aplicar($total)
    {
        if ($total < $this->minimo) {
            return $total;
        }

        if ($this->tipo === 'porcentaje') {
            return $total - ($total * ($this->valor / 100));
        }

        if ($this->tipo === 'fijo') {
            return max(0, $total - $this->valor);
        }

        return $total;
    }
}
