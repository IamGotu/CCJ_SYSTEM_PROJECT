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
            $table->string('sanction')->nullable(); // Add this line
        });
    }
    
    public function down()
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            $table->dropColumn('sanction'); // Drop it if rolling back
        });
    }
};
