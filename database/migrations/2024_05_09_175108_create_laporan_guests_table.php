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
        Schema::create('laporan_guest', function (Blueprint $table) {
            $table->uuid('id_guest')->primary();
            $table->uuid('id_area')->nullable();
            $table->enum('jenis_laporan', ['pengaduan', 'pelayanan']);
            $table->string('nama_guest');
            $table->string('level_guest')->nullable();
            $table->string('image_guest');
            $table->datetime('tgl_guest');
            $table->text('ket_guest')->nullable();
            $table->enum('status_laporan', ['terbaca', 'belum'])->nullable();
            $table->timestamps();
        });

        Schema::table('laporan_guest', function (Blueprint $table) {
            $table->foreign('id_area')->references('id_area')->on('area')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_guest');
    }
};
