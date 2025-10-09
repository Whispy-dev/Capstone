<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id');
            $table->string('name');
            $table->string('type'); // ej: pdf, image, log
            $table->string('path'); // ruta en storage
            $table->timestamps();
        
            $table->foreign('incident_id')->references('id')->on('incidents')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('documents');
    }
};