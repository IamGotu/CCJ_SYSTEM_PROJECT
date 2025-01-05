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
        Schema::create('student_offense_counts', function (Blueprint $table) {
            $table->id();
            $table->string('student_id_number')->unique();
            $table->integer('minor_offense_count')->default(0);
            $table->integer('major_offense_count')->default(0);
            $table->timestamps();

            // Add foreign key reference to the students table
            $table->foreign('student_id_number')
                  ->references('student_id_number')
                  ->on('students')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_offense_counts');
    }
};