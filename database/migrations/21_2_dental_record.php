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
        Schema::create('dental_records', function (Blueprint $table){
            $table->id();
            $table->foreignId('infirmary_id')->nullable()->constrained('clients', 'infirmary_id')->cascadeOnDelete()->nullOnDelete();
            $table->foreignId('dentist')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('or_no')->nullable()->constrained('payments_service','payment_id')->cascadeOnUpdate()->nullOnDelete();
            $table->foreignId('dental_result_id')->nullable()->constrained('dentals')->cascadeOnUpdate()->nullOnDelete();
            $table->boolean('is_out_patient')->default(false);
            $table->enum('status', ['pending','released']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dental_records');
    }
};
