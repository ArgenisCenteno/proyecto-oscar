<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Cupon extends Model
{
    protected $table = 'cupones';

    protected $fillable = [
        'codigo',
        'tipo',
        'valor',
        'minimo',
        'max_uso',
        'usados',
        'fecha_inicio',
        'fecha_fin',
        'activo',
    ];

    protected $casts = [
        'fecha_inicio' => 'datetime',
        'fecha_fin' => 'datetime',
        'activo' => 'boolean'
    ];

    // Verifica si el cupón está activo, vigente y no excedido en uso
    public function estaActivo()
    {
        $hoy = Carbon::now();

        return $this->activo
            && $this->usados < $this->max_uso
            && $hoy->between($this->fecha_inicio, $this->fecha_fin);
    }

    // Aplica el descuento al total
    public function aplicar($total)
    {
        // No aplica si no alcanza el mínimo
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
