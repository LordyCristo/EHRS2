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
        Schema::create('laboratory_requests', function (Blueprint $table){
            $table->id();
            $table->foreignId('infirmary_id')->constrained('clients','infirmary_id');
            $table->foreignId('physician')->constrained('users');
            $table->boolean('urinalysis')->nullable()->default(false);
            $table->boolean('stool_exam')->nullable()->default(false);
            $table->boolean('cbc')->nullable()->default(false);
            $table->boolean('platelet_count')->nullable()->default(false);
            $table->boolean('bleeding_clottting_time')->nullable()->default(false);
            $table->boolean('hemoglobin')->nullable()->default(false);
            $table->boolean('hematocrit')->nullable()->default(false);
            $table->boolean('wbc_diff_count')->nullable()->default(false);
            $table->boolean('blood_typing')->nullable()->default(false);
            $table->boolean('pregnancy_test')->nullable()->default(false);
            $table->boolean('afb_straining')->nullable()->default(false);
            $table->boolean('is_other')->nullable()->default(false);
            $table->string('other_value')->nullable();
            $table->string('ward');
            $table->enum('status',['pending','done','released'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laboratory_requests');
    }
};
