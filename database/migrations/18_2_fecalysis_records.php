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
            $table->foreignId('fecalysis_id')->unique('unq_record_id')->constrained('fecalysis')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('infirmary_id')->constrained('clients', 'infirmary_id')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('medical_technologist')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('pathologist')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('age')->nullable();
            $table->enum('sex', ['male','female']);
            $table->string('ward')->nullable();
            $table->foreignId('or_no')->constrained('payments','or_no')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('rqst_physician')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('hospital_no')->nullable();
            $table->enum('status',['Pending','Processing','Done','Cancelled','Released']);
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
