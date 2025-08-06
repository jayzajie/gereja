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
            // Drop the existing enum constraint and change to string
            $table->string('category', 100)->change();
            $table->string('subcategory', 100)->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information', function (Blueprint $table) {
            // Restore original enum constraints
            $table->enum('category', ['announcement', 'event', 'news', 'program', 'service', 'ministry', 'other'])->change();
            $table->enum('subcategory', ['urgent', 'weekly', 'monthly', 'special', 'youth', 'children', 'adult', 'elderly'])->nullable()->change();
        });
    }
};
