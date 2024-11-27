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
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Change enum to allow null values
            $table->enum('enrollment_status', ['enrolled', 'not_enrolled'])->nullable()->change();
        });
    }
    
    public function down()
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Revert it back to non-nullable if needed
            $table->enum('enrollment_status', ['enrolled', 'not_enrolled'])->change();
        });
    }
    
};
