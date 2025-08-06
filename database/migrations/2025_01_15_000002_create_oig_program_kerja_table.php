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
        Schema::create('oig_program_kerja', function (Blueprint $table) {
            $table->id();
            $table->enum('organisasi', ['PKBGT', 'PWGT', 'PPGT', 'SMGT']);
            $table->string('nama_program');
            $table->text('deskripsi');
            $table->text('tujuan')->nullable();
            $table->text('sasaran')->nullable();
            $table->date('tanggal_mulai')->nullable();
            $table->date('tanggal_selesai')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->enum('status', ['draft', 'aktif', 'selesai', 'dibatalkan'])->default('draft');
            $table->string('gambar')->nullable();
            $table->year('tahun');
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oig_program_kerja');
    }
};