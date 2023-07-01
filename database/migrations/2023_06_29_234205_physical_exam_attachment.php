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
        Schema::create('physical_exam_attachment', function (Blueprint $table) {
            $table->id();
            $table->foreignId('physical_exam_id')->constrained('physical_exams')->cascadeOnDelete()->cascadeOnUpdate();
            $table->longText('image');
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('physical_exam_attachment');
    }
};
