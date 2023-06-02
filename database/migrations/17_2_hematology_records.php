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
        Schema::create('hematology_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('hematology_id')->unique()->constrained('hematology')->onDelete('cascade');
            $table->foreignId('infirmary_id')->constrained('clients', 'infirmary_id')->onDelete('cascade');
            $table->foreignId('medical_technologist')->constrained('users')->onDelete('cascade');
            $table->foreignId('pathologist')->constrained('users')->onDelete('cascade');
            $table->integer('age')->nullable();
            $table->enum('sex', ['male', 'female']);
            $table->string('ward')->nullable();
            $table->foreignId('or_no')->nullable()->constrained('payments', 'or_no')->onDelete('cascade');
            $table->foreignId('rqst_physician')->constrained('users')->onDelete('cascade');
            $table->string('hospital_no')->nullable();
            $table->longText('remarks')->nullable();
            $table->enum('status', ['Pending', 'Processing', 'Done', 'Cancelled', 'Released']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('hematology_records');
    }
};
