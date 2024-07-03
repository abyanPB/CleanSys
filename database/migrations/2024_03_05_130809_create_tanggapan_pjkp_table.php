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
    //     Schema::create('tanggapan_pjkp', function (Blueprint $table) {
    //         $table->uuid('id_tp')->primary();
    //         $table->foreignUuid('id_lp')->nullable()->index()->constrained('laporan_pjkp')->onUpdate('cascade')->onDelete('cascade');
    //         $table->datetime('tgl_tp');
    //         $table->text('tanggapan_pjkp');
    //         $table->foreignUuid('id_users')->nullable()->index()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('tanggapan_pjkp', function (Blueprint $table) {
            $table->uuid('id_tp')->primary();
            $table->uuid('id_lp')->nullable();
            $table->datetime('tgl_tp');
            $table->text('tanggapan_pjkp');
            $table->uuid('id_users')->nullable();
            $table->timestamps();
        });

        Schema::table('tanggapan_pjkp', function (Blueprint $table) {
            $table->foreign('id_lp')->references('id_lp')->on('laporan_pjkp')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanggapan_pjkp');
    }
};
