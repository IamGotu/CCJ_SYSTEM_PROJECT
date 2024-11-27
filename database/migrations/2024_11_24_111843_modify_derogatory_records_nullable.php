<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDerogatoryRecordsNullable extends Migration
{
    public function up()
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Make these fields nullable
            $table->string('last_name')->nullable()->change();
            $table->string('first_name')->nullable()->change();
            $table->string('year_level')->nullable()->change();
            $table->string('school_year')->nullable()->change();
            $table->enum('enrollment_status', ['enrolled', 'not_enrolled', 'graduate'])->nullable()->change();
            $table->string('violation')->nullable()->change();
            $table->string('action_taken')->nullable()->change();
            $table->enum('sanction', ['suspension', 'expulsion', 'verbal_warning', 'written_warning', 'others'])->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('derogatory_records', function (Blueprint $table) {
            // Revert fields back to NOT NULL
            $table->string('last_name')->nullable(false)->change();
            $table->string('first_name')->nullable(false)->change();
            $table->string('year_level')->nullable(false)->change();
            $table->string('school_year')->nullable(false)->change();
            $table->string('enrollment_status')->nullable()->change();
            $table->string('violation')->nullable(false)->change();
            $table->string('action_taken')->nullable(false)->change();
            $table->enum('sanction', ['suspension', 'expulsion', 'verbal_warning', 'written_warning', 'others'])->nullable(false)->change();
        });
    }
}
