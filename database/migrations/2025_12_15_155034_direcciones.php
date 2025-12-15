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
        Schema::create('direcciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Cliente
            $table->string('alias')->nullable(); // Ej: "Casa", "Trabajo"
            $table->string('pais')->default('Venezuela');
            $table->string('estado')->nullable();
            $table->string('ciudad')->nullable();
            $table->string('codigo_postal')->nullable();
            $table->string('direccion')->nullable(); // Calle, número, etc.
            $table->string('telefono')->nullable();
            $table->boolean('predeterminada')->default(false); // Si es dirección principal
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('direcciones');
    }
};
