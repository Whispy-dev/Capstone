<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('slas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id');
            $table->string('name');
            $table->integer('response_time'); // minutos
            $table->integer('resolution_time'); // minutos
            $table->timestamps();
        
            $table->foreign('incident_id')->references('id')->on('incidents')->onDelete('cascade');
        });

    }

    public function down(): void
    {
        Schema::dropIfExists('slas');
    }
};