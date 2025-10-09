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
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('title'); // Título de la reunión
            $table->text('description')->nullable(); // Descripción o notas
            $table->enum('type', ['interna', 'externa', 'incidente'])->default('interna'); // Tipo de evento
            $table->dateTime('start'); // Fecha/hora inicio
            $table->dateTime('end')->nullable(); // Fecha/hora fin
            $table->string('location')->nullable(); // Lugar de la reunión
            $table->string('className')->nullable(); // Clase CSS para colores en el calendario
            $table->timestamps(); // created_at / updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
