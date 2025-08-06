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
        Schema::table('information', function (Blueprint $table) {
            // Change priority from enum to string to avoid truncation issues
            $table->string('priority', 50)->default('medium')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information', function (Blueprint $table) {
            // Restore original enum constraint
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium')->change();
        });
    }
};
