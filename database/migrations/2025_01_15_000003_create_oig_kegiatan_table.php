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
        Schema::create('oig_kegiatan', function (Blueprint $table) {
            $table->id();
            $table->enum('organisasi', ['PKBGT', 'PWGT', 'PPGT', 'SMGT']);
            $table->string('nama_kegiatan');
            $table->text('deskripsi');
            $table->date('tanggal_kegiatan');
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('tempat')->nullable();
            $table->string('penanggung_jawab')->nullable();
            $table->integer('jumlah_peserta')->nullable();
            $table->decimal('anggaran', 15, 2)->nullable();
            $table->enum('status', ['rencana', 'berlangsung', 'selesai', 'dibatalkan'])->default('rencana');
            $table->string('gambar')->nullable();
            $table->text('catatan')->nullable();
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
        Schema::dropIfExists('oig_kegiatan');
    }
};