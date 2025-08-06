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
        Schema::table('baptisms', function (Blueprint $table) {
            // I. KETERANGAN ANAK - Additional fields
            $table->string('tempat_lahir')->nullable()->after('nama_jemaat');
            $table->date('tanggal_lahir')->nullable()->after('tempat_lahir');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan'])->nullable()->after('tanggal_lahir');
            $table->text('alamat_anak')->nullable()->after('jenis_kelamin');
            
            // II. KETERANGAN ORANG TUA (AYAH) - Additional fields
            $table->integer('umur_ayah')->nullable()->after('nama_ayah');
            $table->string('gereja_ayah')->nullable()->after('umur_ayah');
            $table->string('pekerjaan_ayah')->nullable()->after('gereja_ayah');
            $table->text('alamat_ayah')->nullable()->after('pekerjaan_ayah');
            
            // III. KETERANGAN ORANG TUA (IBU) - Additional fields
            $table->integer('umur_ibu')->nullable()->after('nama_ibu');
            $table->string('gereja_ibu')->nullable()->after('umur_ibu');
            $table->string('pekerjaan_ibu')->nullable()->after('gereja_ibu');
            $table->text('alamat_ibu')->nullable()->after('pekerjaan_ibu');
            
            // IV. LAMPIRAN - Additional fields
            $table->string('no_telepon')->nullable()->after('foto');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('baptisms', function (Blueprint $table) {
            $table->dropColumn([
                'tempat_lahir',
                'tanggal_lahir', 
                'jenis_kelamin',
                'alamat_anak',
                'umur_ayah',
                'gereja_ayah',
                'pekerjaan_ayah',
                'alamat_ayah',
                'umur_ibu',
                'gereja_ibu',
                'pekerjaan_ibu',
                'alamat_ibu',
                'no_telepon'
            ]);
        });
    }
};
