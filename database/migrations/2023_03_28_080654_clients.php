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
        Schema::create('clients', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->autoIncrement();
            $table->string('student_id')->unique('clients_code_unique');
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('suffix', 10)->nullable();
            $table->date('birthdate');
            $table->integer('age');
            $table->enum('sex', ['MALE','FEMALE']);
            $table->enum('blood_type', ['A+','A-','B+','B-','AB+','AB-','O+','O-'])->nullable();
            $table->enum('civil_status', ['SINGLE','MARRIED','WIDOWED','SEPARATED','DIVORCED']);
            $table->string('email')->unique('clients_email_unique');
            $table->string('phone')->unique('clients_phone_unique');
            $table->string('home_address', 255);
            $table->string('curr_address', 255);
            $table->foreignId('degree_program_id')->constrained('degree_programs')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('year_level', ['1st','2nd','3rd','4th','5th','6th']);
            $table->foreignId('department_id')->constrained('departments')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('client_type_id')->constrained('client_types')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
