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
        Schema::create('urinalysis', function (Blueprint $table) {
            $table->id();
            $table->string('color')->nullable();
            $table->string('clarity')->nullable();
            $table->string('ph')->nullable();
            $table->string('specific_gravity')->nullable();
            $table->string('albumin')->nullable();
            $table->string('glucose')->nullable();
            $table->string('blood')->nullable();
            $table->string('leukocytes')->nullable();
            $table->string('nitrite')->nullable();
            $table->string('bilirubin')->nullable();
            $table->string('urobilinogen')->nullable();
            $table->string('ketones')->nullable();
            $table->string('wbc')->nullable();
            $table->string('rbc')->nullable();
            $table->string('epithelial_cells')->nullable();
            $table->string('bacteria')->nullable();
            $table->string('amorphous_urates')->nullable();
            $table->string('amorphous_phosphates')->nullable();
            $table->string('mucous_threads')->nullable();
            $table->string('crystals')->nullable();
            $table->string('cast')->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('urinalysis');
    }
};
