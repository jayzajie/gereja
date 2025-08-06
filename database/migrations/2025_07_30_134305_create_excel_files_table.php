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
        Schema::create('excel_files', function (Blueprint $table) {
            $table->id();
            $table->string('original_name'); // Nama file asli
            $table->string('file_path'); // Path file di storage
            $table->string('file_size'); // Ukuran file dalam bytes
            $table->string('mime_type')->nullable(); // MIME type file
            $table->text('description')->nullable(); // Deskripsi file
            $table->enum('status', ['active', 'inactive'])->default('active'); // Status file
            $table->string('uploaded_by')->nullable(); // User yang upload
            $table->timestamp('uploaded_at')->useCurrent(); // Tanggal upload
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('excel_files');
    }
};
