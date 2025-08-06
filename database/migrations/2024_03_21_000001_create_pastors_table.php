<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('pastors', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address')->nullable();
            $table->date('birth_date')->nullable();
            $table->date('ordination_date')->nullable();
            $table->string('status')->default('active'); // active, inactive, retired
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pastors');
    }
}; 