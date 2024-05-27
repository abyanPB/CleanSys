<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // public function up(): void
    // {
    //     Schema::create('tanggapan_grooming', function (Blueprint $table) {
    //         $table->uuid('id_tg')->primary();
    //         $table->foreignUuid('id_lg')->nullable()->index()->constrained('laporan_grooming')->onUpdate('cascade')->onDelete('cascade');
    //         $table->datetime('tgl_tg');
    //         $table->text('tanggapan_grooming');
    //         $table->foreignUuid('id_users')->nullable()->index()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('tanggapan_grooming', function (Blueprint $table) {
            $table->uuid('id_tg')->primary();
            $table->uuid('lg_id')->nullable();
            $table->datetime('tgl_tg');
            $table->text('tanggapan_grooming');
            $table->uuid('user_id')->nullable();
            $table->timestamps();
        });

        Schema::table('tanggapan_grooming', function (Blueprint $table) {
            $table->foreign('lg_id')->references('id_lg')->on('laporan_grooming')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan_grooming');
    }
};
