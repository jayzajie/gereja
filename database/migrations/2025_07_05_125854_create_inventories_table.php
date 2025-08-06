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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('kategori');
            $table->text('deskripsi')->nullable();
            $table->integer('jumlah')->default(0);
            $table->decimal('harga_satuan', 15, 2)->default(0);
            $table->decimal('total_nilai', 15, 2)->default(0);
            $table->string('satuan')->default('pcs'); // unit: pcs, kg, liter, etc.
            $table->string('lokasi')->nullable();
            $table->date('tanggal_masuk')->nullable();
            $table->date('tanggal_kadaluarsa')->nullable();
            $table->enum('status', ['tersedia', 'habis', 'rusak'])->default('tersedia');
            $table->string('supplier')->nullable();
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inventories');
    }
};
