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
            $table->id();
            $table->bigInteger('infirmary_id')->unique('clients_infirmary_id_unique')->unsigned();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name' );
            $table->string('suffix')->nullable();
            $table->date('birthdate');
            $table->integer('age');
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->enum('sex', ['male','female']);
            $table->enum('civil_status', ['single','married','widowed','separated','divorced']);
            $table->string('phone')->unique('clients_phone_unique');
            $table->string('email_address')->nullable()->unique('clients_email_address_unique');
            $table->string('home_address', 255);
            $table->string('curr_address', 255);
            $table->string('employer')->nullable();
            $table->string('id_number')->nullable()->unique('clients_id_number_unique');
            $table->foreignId('program_id')->nullable()->constrained('degree_programs')->onDelete('cascade')->onUpdate('cascade');
            $table->enum('year_lvl', ['1st', '2nd','3rd','4th','5th','6th'])->nullable();
            $table->foreignId('client_type_id')->constrained('client_types')->onDelete('cascade')->onUpdate('cascade');
            $table->boolean('is_emergency')->default(false);
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
