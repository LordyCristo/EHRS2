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
        Schema::create('payments_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('payment_id')->constrained('payments', 'or_no')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('service_id')->constrained('fees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->float('fee', 10, 2);
            $table->timestamps();
            // Add any additional columns related to the payment-service relationship
            $table->unique(['payment_id', 'service_id']);
            $table->softDeletes();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_service');
    }
};
