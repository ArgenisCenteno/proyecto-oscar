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
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            // Relación con subcategorías
            $table->unsignedBigInteger('subcategoria_id');
            $table->foreign('subcategoria_id')->references('id')->on('subcategorias')->onDelete('cascade');

            $table->string('nombre');
            $table->string('slug')->unique();
            $table->text('descripcion')->nullable();

            $table->decimal('precio', 10, 2);
            $table->integer('stock')->default(0);
            $table->string('sku')->nullable()->unique();

            $table->enum('estado', ['Activo', 'Inactivo'])->default('Activo');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
