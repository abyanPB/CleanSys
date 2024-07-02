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
        Schema::create('sop', function (Blueprint $table) {
            $table->uuid('id_sop')->primary();
            $table->string('nama_sop');
            $table->string('tujuan_sop');
            $table->text('cara_penggunaan_sop');
            $table->text('perawatan_peralatan_sop');
            $table->text('keselamatan_kerja_sop');
            $table->string('image_sop')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sop');
    }
};
