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
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('first_name', 100);
            $table->string('middle_name', 100)->nullable();
            $table->string('last_name', 100);
            $table->string('suffix', 10)->nullable();
            $table->date('birthdate');
            $table->integer('age');
            $table->enum('sex', ['MALE', 'FEMALE']);
            $table->foreignId('role_id')->constrained('account_types')->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('specialization', 255)->nullable();
            $table->string('curr_position', 255)->nullable();
            $table->string('license_no', 255)->unique('user_accounts_license_no_unique')->nullable();
            $table->string('telephone', 255)->nullable();
            $table->string('mobile', 255)->unique('user_accounts_mobile_unique')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
