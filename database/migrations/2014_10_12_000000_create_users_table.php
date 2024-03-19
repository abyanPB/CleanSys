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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id_users')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('jk',['laki-laki','perempuan'])->nullable();
            $table->string('no_telepon')->nullable();
            $table->enum('level',['admin','spv','cleaner']);
            $table->string('image')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
