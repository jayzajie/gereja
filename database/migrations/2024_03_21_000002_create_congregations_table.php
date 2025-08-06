<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('congregations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->string('phone')->nullable();
            $table->string('email')->nullable();
            $table->foreignId('pastor_id')->nullable()->constrained()->onDelete('set null');
            $table->string('status')->default('active'); // active, inactive
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('congregations');
    }
}; 