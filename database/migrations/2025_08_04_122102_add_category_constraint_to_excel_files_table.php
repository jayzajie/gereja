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
        Schema::table('excel_files', function (Blueprint $table) {
            // Ubah kolom category menjadi enum dengan nilai yang valid
            $table->enum('category', ['data-jemaat', 'program-kerja'])->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('excel_files', function (Blueprint $table) {
            // Kembalikan ke string biasa
            $table->string('category')->nullable()->change();
        });
    }
};
