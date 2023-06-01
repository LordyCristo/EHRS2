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
            $table->string('color')->nullable();
            $table->string('consistency')->nullable();
            $table->string('ova')->nullable();
            $table->double('wbc')->nullable();
            $table->double('rbc')->nullable();
            $table->double('fat_globules')->nullable();
            $table->string('others')->nullable();
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
        Schema::dropIfExists('fecalysis');
    }
};
