<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Add the violation_id column (foreign key to violations table)
            $table->unsignedBigInteger('violation_id')->nullable();

            // Add penalty column to store the penalty for the violation
            $table->text('penalty')->nullable();

            // Add the foreign key constraint for violation_id referencing violations table
            $table->foreign('violation_id')
                  ->references('id')
                  ->on('violations')
                  ->onDelete('set null'); // If a violation is deleted, set the violation_id to null
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Drop the foreign key and columns if rolling back the migration
            $table->dropForeign(['violation_id']);
            $table->dropColumn(['violation_id', 'penalty']);
        });
    }
};
