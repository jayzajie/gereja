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
        Schema::create('worship_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Nama ibadah (Ibadah Pagi, Ibadah Utama, dll)
            $table->time('time'); // Waktu ibadah
            $table->string('day'); // Hari (Setiap Minggu, dll)
            $table->string('icon')->default('fas fa-church'); // Icon untuk tampilan
            $table->text('description')->nullable(); // Deskripsi tambahan
            $table->json('special_notes')->nullable(); // Catatan khusus (JSON)
            $table->string('target_audience')->default('Semua Umur'); // Target jemaat
            $table->integer('duration')->nullable(); // Durasi dalam menit
            $table->boolean('is_featured')->default(false); // Apakah ibadah utama
            $table->boolean('is_active')->default(true); // Status aktif
            $table->integer('sort_order')->default(0); // Urutan tampilan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('worship_schedules');
    }
};