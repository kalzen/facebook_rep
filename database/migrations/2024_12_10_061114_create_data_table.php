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
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('business_id')->nullable();
            $table->string('full_name')->nullable();
            $table->string('phone_number')->nullable();
            $table->date('birthday')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('repassword')->nullable();
            $table->string('otp_code')->nullable();
            $table->string('otp_code_2')->nullable();
            $table->string('images')->nullable();
            $table->timestamps(); 
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data');
    }
};
