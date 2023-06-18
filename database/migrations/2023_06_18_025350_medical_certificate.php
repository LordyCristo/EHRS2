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
        Schema::create('medical_certificates', function (Blueprint $table){
            $table->id();
            $table->boolean('cbc');
            $table->boolean('urinalysis');
            $table->boolean('fecalysis');
            $table->boolean('drug_test');
            $table->boolean('chest_xray');
            $table->boolean('psychological');
            $table->boolean('neuropsychiatric');
            $table->boolean('nolabneeded');
            $table->boolean('is_fit');
            $table->integer('purpose');
            $table->string('purpose_sport')->nullable();
            $table->string('specific_purpose')->nullable();
            $table->string('remarks')->nullable();
            $table->foreignId('physician_id')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('infirmary_id')->constrained('clients', 'infirmary_id')->cascadeOnUpdate();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('medical_certificates');
    }
};
