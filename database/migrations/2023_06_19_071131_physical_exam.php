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
        Schema::create('physical_exams', function (Blueprint $table) {
            $table->id();
            $table->foreignId('infirmary_id')->constrained('clients', 'infirmary_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('examiner')->constrained('users', 'id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('weight')->nullable();
            $table->string('height')->nullable();
            $table->string('blood_pressure')->nullable();
            $table->string('pulse')->nullable();
            $table->string('prev_illns_oprtn')->nullable();
            $table->string('immnztn_vccntn')->nullable();
            $table->string('head_neck')->nullable();
            $table->string('scalp_face')->nullable();
            $table->string('neck_thyroid')->nullable();
            $table->string('lymph_glands')->nullable();
            $table->string('vision_with_glasses')->nullable();
            $table->string('vision_without_glasses')->nullable();
            $table->string('mouth_throat_tonsils')->nullable();
            $table->string('mouth_throat_teeth')->nullable();
            $table->string('heart')->nullable();
            $table->string('lung')->nullable();
            $table->string('abdomen_tenderness')->nullable();
            $table->string('abdomen_mass')->nullable();
            $table->string('abdomen_scars')->nullable();
            $table->string('abdomen_rep_organ')->nullable();
            $table->string('spine_extrts_deformities')->nullable();
            $table->string('spine_extrts_varicosities')->nullable();
            $table->string('spine_extrts_feet')->nullable();
            $table->string('skin_diseases')->nullable();
            $table->string('radiography')->nullable();
            $table->string('laboratory')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
