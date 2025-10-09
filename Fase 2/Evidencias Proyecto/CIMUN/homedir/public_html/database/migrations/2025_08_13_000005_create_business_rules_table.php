<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('business_rules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('incident_id');
            $table->string('trigger_type'); // ej: status_change, priority_escalation
            $table->string('condition');    // ej: status == 'open'
            $table->string('action');       // ej: notify_user, escalate
            $table->timestamps();
        
            $table->foreign('incident_id')->references('id')->on('incidents')->onDelete('cascade');
        });


    }

    public function down(): void
    {
        Schema::dropIfExists('business_rules');
    }
};