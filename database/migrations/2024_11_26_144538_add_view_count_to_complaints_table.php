<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->integer('view_count')->default(0)->after('evidence_files'); // Add view_count column
        });
    }
    
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('view_count'); // Remove view_count column if needed
        });
    }
};