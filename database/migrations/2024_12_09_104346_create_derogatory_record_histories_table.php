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
        Schema::create('derogatory_record_histories', function (Blueprint $table) {
            $table->id();
            // Reference student_id_number in the students table
            $table->string('student_id_number')->unique(); // Change to string for student_id_number
            $table->foreign('student_id_number')->references('student_id_number')->on('students')->onDelete('cascade');
            
            // Reference id in the violations table
            $table->foreignId('violation_id')->constrained()->onDelete('cascade');
            
            $table->string('penalty');
            $table->string('action_taken');
            $table->boolean('settled');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derogatory_record_histories');
    }
};
