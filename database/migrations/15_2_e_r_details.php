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
        Schema::create('er_details', function (Blueprint $table) {
            $table->foreignId('infirmary_id')->constrained('clients', 'infirmary_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->date('date_admitted')->nullable();
            $table->time('time_admitted')->nullable();
            $table->string('brought_by')->nullable();
            $table->string('arrival_condition')->nullable();
            $table->string('temperature')->nullable();
            $table->string('temperature_location')->nullable();
            $table->string('weight')->nullable();
            $table->string('pulse_rate')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('cardiac_rate')->nullable();
            $table->string('respiratory_rate')->nullable();
            $table->string('oxygen_saturation')->nullable();
            $table->string('chief_complaint')->nullable();
            $table->string('allergies')->nullable();
            $table->string('physical_exam')->nullable();
            $table->string('current_medications')->nullable();
            $table->string('treatment')->nullable();
            $table->string('nurse_notes')->nullable();
            $table->string('diagnosis')->nullable();
            $table->date('date_disposition')->nullable();
            $table->time('time_disposition')->nullable();
            $table->string('discharge_condition')->nullable();
            $table->string('attending_nurse')->nullable();
            $table->string('attending_physician')->nullable();
            $table->primary('infirmary_id');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('er_details');
    }
};
