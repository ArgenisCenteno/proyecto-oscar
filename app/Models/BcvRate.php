<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BcvRate extends Model
{
    // Tabla personalizada (opcional si sigue convención)
    protected $table = 'bcv_rates';

    // Atributos que se pueden asignar masivamente
    protected $fillable = [
        'fecha',
        'precio',
        'precio_anterior',
        'cambio',
        'porcentaje',
        'capturado_en',
    ];

    // Casts de datos para convertir automáticamente los campos
    protected $casts = [
        'fecha' => 'date',
        'capturado_en' => 'datetime',
        'precio' => 'decimal:4',
        'precio_anterior' => 'decimal:4',
        'cambio' => 'decimal:4',
        'porcentaje' => 'decimal:2',
    ];

    // Fechas que Laravel manejará como Carbon instances
    protected $dates = [
        'fecha',
        'capturado_en',
        'created_at',
        'updated_at',
    ];

    // Opcional: método para obtener la tasa más reciente
    public static function tasaActual()
    {
        return self::orderByDesc('fecha')->first();
    }

    // Opcional: tasa de hoy
    public static function tasaDeHoy()
    {
        return self::where('fecha', now()->startOfDay())->first();
    }
}
