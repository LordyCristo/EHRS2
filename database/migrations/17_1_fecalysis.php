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
        Schema::create('fecalysis', function (Blueprint $table) {
            $table->id();
            $table->double('hemoglobin')->nullable();
            $table->double('hematocrit')->nullable();
            $table->double('wbc')->nullable();
            $table->double('rbc')->nullable();
            $table->double('platelet_count')->nullable();
            $table->double('segmenters')->nullable();
            $table->double('lymphocyte')->nullable();
            $table->double('monocyte')->nullable();
            $table->string('blood_type')->nullable();
            $table->longText('diagnosis');
            $table->longText('remarks')->nullable()->default(null);
            $table->enum('status',['Pending','Processing','Done','Cancelled']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fecalysis');
    }
};
