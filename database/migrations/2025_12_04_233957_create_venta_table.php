<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->string('tipo')->default('Venta Online'); // Venta Online / Presencial / etc
            $table->enum('estado', ['Pagado', 'No Pagado', 'Cancelado', 'En Revisión'])->default('No Pagado');
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete(); // cliente
            $table->decimal('subtotal', 10, 2)->default(0);
            $table->decimal('descuento', 10, 2)->default(0); // total de descuentos aplicados
            $table->decimal('total', 10, 2)->default(0); // subtotal - descuento
            $table->boolean('entregado')->default(false);
            $table->decimal('total_bs', 10, 2)->default(0); // total en bolívares
            $table->string('moneda')->default('USD');       // USD, EUR, etc
            $table->decimal('tasa', 10, 2)->default(1);     // tipo de cambio

            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
