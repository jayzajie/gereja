<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Hapus semua data yang tidak memiliki kategori yang valid
        DB::table('excel_files')
            ->whereNotIn('category', ['data-jemaat', 'program-kerja'])
            ->orWhereNull('category')
            ->delete();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak ada rollback untuk operasi delete
    }
};
