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
        Schema::table('interns', function (Blueprint $table) {
            // Modify to simple TEXT column
            DB::statement('ALTER TABLE interns MODIFY documents TEXT NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('interns', function (Blueprint $table) {
            // If needed to rollback, convert back to LONGTEXT
            DB::statement('ALTER TABLE interns MODIFY documents LONGTEXT NULL');
        });
    }
};
