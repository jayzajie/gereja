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
        Schema::create('sejarah_jemaats', function (Blueprint $table) {
            $table->id();
            $table->string('title')->default('Sejarah Gereja Toraja Jemaat Eben-Haezer Selili'); // Judul
            $table->text('content'); // Konten sejarah
            $table->string('logo')->nullable(); // Logo jemaat
            $table->string('banner_image')->nullable(); // Gambar banner
            $table->string('established_year')->nullable(); // Tahun berdiri
            $table->text('address')->nullable(); // Alamat jemaat
            $table->string('phone')->nullable(); // Telepon
            $table->string('email')->nullable(); // Email
            $table->boolean('is_active')->default(true); // Status aktif
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sejarah_jemaats');
    }
};
