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
        Schema::table('ojt_records', function (Blueprint $table) {
            $table->unsignedBigInteger('coordinator_id')->nullable()->after('credit_hours');

            $table->foreign('coordinator_id')->references('id')->on('coordinators')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ojt_records', function (Blueprint $table) {
            $table->dropForeign(['coordinator_id']);
            $table->dropColumn('coordinator_id');
        });
    }
};
