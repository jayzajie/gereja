<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('marriages', function (Blueprint $table) {
            $table->id();
            $table->string('nama_calon_pria');
            $table->date('tanggal_lahir_pria');
            $table->string('tempat_lahir_pria')->nullable();
            $table->string('alamat_pria');
            $table->string('pekerjaan_pria');
            $table->string('no_telepon_pria')->nullable();
            $table->string('email_pria')->nullable();
            $table->string('nama_ayah_pria');
            $table->string('nama_ibu_pria');
            
            $table->string('nama_calon_wanita');
            $table->date('tanggal_lahir_wanita');
            $table->string('tempat_lahir_wanita')->nullable();
            $table->string('alamat_wanita');
            $table->string('pekerjaan_wanita');
            $table->string('no_telepon_wanita')->nullable();
            $table->string('email_wanita')->nullable();
            $table->string('nama_ayah_wanita');
            $table->string('nama_ibu_wanita');
            
            $table->date('tanggal_pernikahan');
            $table->string('tempat_pernikahan');
            $table->string('saksi');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('marriages');
    }
};