<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('category_municipality_sla', function (Blueprint $table) {
            $table->id();

            $table->foreignId('incident_category_id')
                  ->constrained('incident_categories')
                  ->onDelete('cascade');

            $table->foreignId('municipality_id')
                  ->constrained('municipalities')
                  ->onDelete('cascade');

            $table->unsignedInteger('sla_hours')->default(24);
            $table->enum('sla_type', ['respuesta', 'resolución', 'escalamiento'])->default('respuesta');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('category_municipality_sla');
    }
};