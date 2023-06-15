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
        Schema::create('fecalysis_records', function(Blueprint $table){
            $table->id();
            $table->foreignId('infirmary_id')->nullable()->constrained('clients', 'infirmary_id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('fecalysis_id')->unique()->constrained('fecalysis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('rqst_physician')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('medical_technologist')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('pathologist')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('or_no')->nullable()->constrained('payments_service','payment_id')->cascadeOnUpdate()->nullOnDelete();
            $table->string('ward')->nullable();
            $table->enum('status',['pending','done','released']);
            $table->boolean('is_out_patient')->default(false);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fecalysis_records');
    }
};
