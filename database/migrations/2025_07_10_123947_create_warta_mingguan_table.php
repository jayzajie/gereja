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
        Schema::create('warta_mingguan', function (Blueprint $table) {
            $table->id();
            $table->string('nama_warta');
            $table->string('file_path');
            $table->string('file_name');
            $table->bigInteger('file_size');
            $table->integer('tanggal');
            $table->integer('bulan');
            $table->integer('tahun');
            $table->text('deskripsi')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warta_mingguan');
    }
};
