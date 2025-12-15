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
        Schema::create('bcv_rates', function (Blueprint $table) {
            $table->id();
            $table->date('fecha')->unique(); // Fecha del día al que corresponde la tasa
            $table->decimal('precio', 10, 4); // Precio del dólar oficial
            $table->decimal('precio_anterior', 10, 4)->nullable(); // Comparación
            $table->decimal('cambio', 10, 4)->nullable(); // Diferencia con anterior
            $table->decimal('porcentaje', 5, 2)->nullable(); // % de cambio
            $table->timestamp('capturado_en')->nullable(); // Cuándo se hizo el scraping
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bcv_rates');
    }
};
