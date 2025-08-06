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
        // Drop existing members table if exists
        Schema::dropIfExists('members');

        // Create new members table
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->string('nama_lengkap');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->date('tanggal_lahir');
            $table->string('tempat_lahir');
            $table->text('alamat');
            $table->string('no_hp')->nullable();
            $table->string('email')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->enum('status_pernikahan', ['Belum Menikah', 'Menikah', 'Duda', 'Janda'])->default('Belum Menikah');
            $table->string('nama_ayah')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('nama_pasangan')->nullable();
            $table->date('tanggal_baptis')->nullable();
            $table->string('tempat_baptis')->nullable();
            $table->date('tanggal_sidi')->nullable();
            $table->string('tempat_sidi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('members');
    }
};
