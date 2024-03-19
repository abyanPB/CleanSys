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
    //     Schema::create('laporan_pjkp', function (Blueprint $table) {
    //         $table->uuid('ig_lp')->primary();
    //         $table->foreignUuid('id_users')->nullable()->index()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
    //         $table->foreignUuid('id_area')->nullable()->index()->constrained('area')->onUpdate('cascade')->onDelete('cascade');
    //         $table->foreignUuid('id_sop')->nullable()->index()->constrained('sop')->onUpdate('cascade')->onDelete('cascade');
    //         $table->datetime('tgl_lp');
    //         $table->string('image_lp')->nullable();
    //         $table->enum('status_lp',['sebelum','proses','hasil']);
    //         $table->timestamps();
    //     });
    // }

    public function up(): void
    {
        Schema::create('laporan_pjkp', function (Blueprint $table) {
            $table->uuid('id_lp')->primary();
            $table->uuid('id_users')->nullable();
            $table->uuid('id_area')->nullable();
            $table->uuid('id_sop')->nullable();
            $table->datetime('tgl_lp');
            $table->string('image_lp')->nullable();
            $table->enum('status_lp',['sebelum','proses','hasil']);
            $table->timestamps();
        });

        Schema::table('laporan_pjkp', function (Blueprint $table) {
            $table->foreign('id_users')->references('id_users')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_area')->references('id_area')->on('area')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_sop')->references('id_sop')->on('sop')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_pjkp');
    }
};
