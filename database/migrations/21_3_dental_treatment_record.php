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
        Schema::create('dental_treatment_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dental_record_id')->nullable()->constrained('dental_records', 'dental_result_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('diagnosis');
            $table->foreignId('service_id')->nullable()->constrained('fees')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('tooth_location');
            $table->string('operator');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dental_treatment_records');
    }
};
