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
        Schema::table('derogatory_record_histories', function (Blueprint $table) {
            $table->string('approved_by')->nullable(); // Add this line
        });
    }
    
    public function down()
    {
        Schema::table('derogatory_record_histories', function (Blueprint $table) {
            $table->dropColumn('approved_by'); // Remove the column if rollback
        });
    }
    
};
