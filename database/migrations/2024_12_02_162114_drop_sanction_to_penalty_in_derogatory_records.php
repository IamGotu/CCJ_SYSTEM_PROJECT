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
          
            $table->dropColumn('sanction');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Re-add the 'sanction' column in case of rollback
            $table->string('sanction')->nullable();
        });
    }
};

