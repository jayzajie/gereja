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
        Schema::table('members', function (Blueprint $table) {
            // Add new fields for family member registration
            $table->string('nomor_anggota')->nullable()->after('id');
            $table->enum('status_baptis', ['S', 'B'])->nullable()->after('tempat_sidi');
            $table->enum('status_sidi', ['S', 'B'])->nullable()->after('status_baptis');
            $table->string('tempat_nikah')->nullable()->after('status_sidi');
            $table->date('tanggal_nikah')->nullable()->after('tempat_nikah');
            $table->string('hubungan_keluarga')->nullable()->after('tanggal_nikah');
            $table->string('pendidikan')->nullable()->after('hubungan_keluarga');
            
            // Update jenis_kelamin enum to match new format
            $table->dropColumn('jenis_kelamin');
        });
        
        // Add jenis_kelamin back with new enum values
        Schema::table('members', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['Lk', 'Pr'])->after('nama_lengkap');
        });
        
        // Update status_pernikahan enum to match new format
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('status_pernikahan');
        });
        
        Schema::table('members', function (Blueprint $table) {
            $table->enum('status_pernikahan', ['K', 'B', 'J', 'D'])->default('B')->after('pendidikan');
        });
        
        // Update status enum
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn('status');
        });
        
        Schema::table('members', function (Blueprint $table) {
            $table->enum('status', ['pending', 'active', 'inactive'])->default('pending')->after('status_pernikahan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('members', function (Blueprint $table) {
            $table->dropColumn([
                'nomor_anggota',
                'status_baptis',
                'status_sidi',
                'tempat_nikah',
                'tanggal_nikah',
                'hubungan_keluarga',
                'pendidikan'
            ]);
            
            // Restore original enums
            $table->dropColumn('jenis_kelamin');
            $table->dropColumn('status_pernikahan');
            $table->dropColumn('status');
        });
        
        Schema::table('members', function (Blueprint $table) {
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->after('nama_lengkap');
            $table->enum('status_pernikahan', ['Belum Menikah', 'Menikah', 'Duda', 'Janda'])->default('Belum Menikah')->after('pekerjaan');
            $table->enum('status', ['active', 'inactive'])->default('active')->after('foto');
        });
    }
};
