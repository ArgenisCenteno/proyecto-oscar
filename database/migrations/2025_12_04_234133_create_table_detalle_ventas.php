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
        Schema::create('detalles_ventas', function (Blueprint $table) {
    $table->id();
    $table->foreignId('venta_id')->constrained('ventas')->cascadeOnDelete();
    $table->foreignId('producto_id')->constrained('productos')->cascadeOnDelete();
    $table->integer('cantidad')->default(1);
    $table->decimal('precio', 10,2);
    $table->decimal('descuento', 10,2)->default(0); 
    $table->decimal('subtotal', 10,2); // precio*cantidad - descuento
    $table->json('variantes')->nullable(); // JSON para color, talla, etc
    $table->timestamps();
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalles_ventas');
    }
};
