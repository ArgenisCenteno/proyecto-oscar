<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pagos', function (Blueprint $table) {
    $table->id();
    $table->foreignId('venta_id')->constrained('ventas')->cascadeOnDelete();
    $table->enum('metodo', ['efectivo','tarjeta','transferencia','pago_movil','paypal','binance', 'zelle'])->default('efectivo');
  $table->enum('estado', ['Pagado','Anulado','En Revisión'])->default('En Revisión');
    $table->string('origen')->nullable();      // Ej: banco, cuenta, tarjeta
    $table->string('destino')->nullable();     // Ej: banco receptor
    $table->string('referencia')->nullable();  // Ej: nro de transacción
    $table->dateTime('fecha_pago')->nullable();
    $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // cliente

    $table->decimal('monto', 10,2);
    $table->string('detalle')->nullable(); // información extra
     $table->decimal('monto_bs', 10,2)->default(0); // monto en bolívares
            $table->string('moneda')->default('USD');       // USD, EUR, etc
            $table->decimal('tasa', 10,2)->default(1);     // tipo de cambio
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
