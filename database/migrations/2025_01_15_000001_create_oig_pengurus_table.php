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
        Schema::create('oig_pengurus', function (Blueprint $table) {
            $table->id();
            $table->enum('organisasi', ['PKBGT', 'PWGT', 'PPGT', 'SMGT']);
            $table->string('nama_lengkap');
            $table->string('jabatan');
            $table->text('deskripsi')->nullable();
            $table->string('foto')->nullable();
            $table->string('no_telepon')->nullable();
            $table->string('email')->nullable();
            $table->year('periode_mulai');
            $table->year('periode_selesai');
            $table->boolean('is_active')->default(true);
            $table->integer('urutan')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('oig_pengurus');
    }
};