<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use App\Models\BcvRate;
use App\Services\DollarService;
use Carbon\Carbon;

class ActualizarTasaBCV extends Command
{
    protected $signature = 'bcv:actualizar-tasa';
    protected $description = 'Consulta la tasa del BCV y actualiza el registro diario (máximo 7 días)';

    public function handle()
    {
        $hoy = Carbon::now()->startOfDay();

        // Verifica si ya existe un registro para hoy
        if (BcvRate::where('fecha', $hoy)->exists()) {
            $this->info("Ya existe un registro de tasa para hoy ({$hoy->toDateString()}).");
            return;
        }

        $dollarService = new DollarService();
        $response = $dollarService->getDollarPrice();

        if (!isset($response['promedio'])) {
            $this->error('La respuesta de la API no contiene el precio esperado.');
            return;
        }

        $precio = $response['promedio'];
        $precioAnterior = BcvRate::latest('fecha')->first()?->precio;
        $cambio = $precioAnterior !== null ? $precio - $precioAnterior : null;
        $porcentaje = $precioAnterior > 0 ? round(($cambio / $precioAnterior) * 100, 2) : null;

        BcvRate::create([
            'fecha' => $hoy,
            'precio' => $precio,
            'precio_anterior' => $precioAnterior,
            'cambio' => $cambio,
            'porcentaje' => $porcentaje,
            'capturado_en' => now(),
        ]);

        // Eliminar registros más antiguos de 7 días
       // BcvRate::where('fecha', '<', $hoy->copy()->subDays(7))->delete();

        $this->info("Tasa del BCV registrada correctamente para {$hoy->toDateString()}: Bs.{$precio}");
    }
}
