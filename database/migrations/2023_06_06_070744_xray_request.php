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
        Schema::create('xray_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('infirmary_id')->nullable()->constrained('clients', 'infirmary_id')->cascadeOnDelete()->nullOnDelete();
            $table->foreignId('or_no')->nullable()->constrained('payments_service','payment_id')->cascadeOnUpdate()->nullOnDelete();
            $table->string('rqst_for');
            $table->string('history');
            $table->foreignId('rqst_physician')->nullable()->constrained('users')->cascadeOnUpdate()->nullOnDelete();
            $table->string('ward')->nullable();
            $table->enum('status', ['pending','released']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('xray_requests');
    }
};
