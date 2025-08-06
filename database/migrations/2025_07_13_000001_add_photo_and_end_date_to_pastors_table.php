<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pastors', function (Blueprint $table) {
            $table->string('photo')->nullable()->after('status');
            $table->date('end_date')->nullable()->after('photo');
        });
    }

    public function down()
    {
        Schema::table('pastors', function (Blueprint $table) {
            $table->dropColumn(['photo', 'end_date']);
        });
    }
};
