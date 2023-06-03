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
            $table->bigInteger('or_no')->unique('unq_or_no')->unsigned();
            $table->string('payor_name')->nullable();
            $table->string('payor_email')->nullable();
            $table->string('payor_mobile')->nullable();
            $table->foreignId('infirmary_id')->constrained('clients','infirmary_id')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignId('collector_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->decimal('total_amount', 10, 2);
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
