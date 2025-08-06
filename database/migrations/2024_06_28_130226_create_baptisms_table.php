<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('baptisms', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_baptis');
            $table->string('nama_jemaat');
            $table->string('nama_ayah');
            $table->string('nama_ibu');
            $table->date('tanggal_baptis');
            $table->string('foto')->nullable();
            $table->string('dibaptis_oleh');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('baptisms');

    }
};