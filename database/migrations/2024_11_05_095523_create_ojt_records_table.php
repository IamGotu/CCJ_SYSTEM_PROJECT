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
        Schema::create('ojt_records', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('student_number')->unique();
            $table->string('agency_assigned')->nullable();
            $table->string('roster_number')->nullable();
            $table->string('school_year');
            $table->string('year_level')->nullable();
            $table->integer('credit_hours');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ojt_records');
    }
};
