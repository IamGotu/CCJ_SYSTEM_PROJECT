<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Drop the redundant 'violation' column
            $table->dropColumn('violation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Re-add the 'violation' column in case of rollback
            $table->string('violation')->nullable();
        });
    }
};
