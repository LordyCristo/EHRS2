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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payor_name');
            $table->string('payor_email');
            $table->string('payor_mobile');
            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('service_id')->constrained('fees')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('collector_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('amount', 10, 3);
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
        Schema::dropIfExists('payments');
    }
};
