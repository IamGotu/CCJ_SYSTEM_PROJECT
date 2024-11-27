<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEvidenceFilesToComplaintsTable extends Migration
{
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->json('evidence_files')->nullable(); // Add a JSON column for evidence files
        });
    }

    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('evidence_files'); // Remove the column if rolling back
        });
    }
}
