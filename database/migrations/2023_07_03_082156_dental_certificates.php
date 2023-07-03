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
        Schema::create('dental_certificates', function(Blueprint $table){
            $table->id();
            $table->foreignId('dentist')->constrained('users')->cascadeOnUpdate();
            $table->foreignId('infirmary_id')->constrained('clients', 'infirmary_id')->cascadeOnUpdate();
            $table->foreignId('or_no')->constrained('payments', 'or_no')->cascadeOnUpdate();
            $table->longText('diagnosis');
            $table->boolean('num_days');
            $table->date('admission_date');
            $table->date('discharge_date');
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
        //
    }
};
