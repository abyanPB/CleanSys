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
        Schema::create('area_responsibility', function (Blueprint $table) {
            $table->uuid('id_ar')->primary();
            $table->uuid('user_id');
            $table->uuid('area_id');
            $table->timestamps();

            $table->foreign('user_id')->references('id_users')->on('users')->onDelete('cascade');
            $table->foreign('area_id')->references('id_area')->on('area')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('area_responsibility');
    }
};
