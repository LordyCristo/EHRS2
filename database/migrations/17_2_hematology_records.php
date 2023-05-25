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
        Schema::create('hematology_records', function(Blueprint $table){
            $table->foreignId('id')->unique('unq_record_id')->constrained('hematology')->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignId('client_id')->constrained('clients')->cascadeOnUpdate()->cascadeOnDelete();
            $table->integer('age')->nullable();
            $table->enum('sex', ['male','female']);
            $table->string('ward')->nullable();
            $table->string('or_no')->unique('unq_or_no');
            $table->foreignId('rqst_physician')->constrained('users')->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('hospital_no')->nullable();
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
