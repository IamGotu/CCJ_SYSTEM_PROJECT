<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->string('year_level')->nullable()->after('middle_name');
        });
    }

    public function down()
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->dropColumn('year_level');
        });
    }
};