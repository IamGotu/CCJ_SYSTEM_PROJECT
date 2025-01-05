<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->string('cibat_class')->nullable();
            $table->string('batch_name')->nullable();
        });
    }

    public function down()
    {
        Schema::table('interns', function (Blueprint $table) {
            $table->dropColumn(['cibat_class', 'batch_name']);
        });
    }
}; 