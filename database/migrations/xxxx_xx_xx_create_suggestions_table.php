<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('suggestions', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('no_hp');
            $table->string('nama_gmail');
            $table->text('saran');
            $table->string('status')->default('unread');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('suggestions');
    }
};
