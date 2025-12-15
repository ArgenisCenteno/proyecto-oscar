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
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id();
            
            // Usuario que agregó el producto, nullable para invitados
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            
            // Producto principal
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            
            // Variante del producto (nullable)
            $table->foreignId('variante_id')->nullable()->constrained('producto_variantes')->onDelete('cascade');
            
            // Cantidad y precio al momento de agregar al carrito
            $table->integer('cantidad')->default(1);
            $table->decimal('precio', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
