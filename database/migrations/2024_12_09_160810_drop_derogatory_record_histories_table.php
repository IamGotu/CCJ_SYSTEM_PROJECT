<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropDerogatoryRecordHistoriesTable extends Migration
{
    public function up()
    {
        Schema::dropIfExists('derogatory_record_histories');
    }

    public function down()
    {
        // Optionally, you can recreate the table structure here if needed
        Schema::create('derogatory_record_histories', function (Blueprint $table) {
            $table->id();
            $table->string('student_id_number'); // Assuming this is a string, adjust as necessary
            $table->unsignedBigInteger('violation_id'); // Adjust type as necessary
            $table->string('penalty');
            $table->string('action_taken');
            $table->boolean('settled');
            $table->timestamps();

            // Add foreign key constraints if needed
            $table->foreign('student_id_number')->references('student_id_number')->on('students')->onDelete('cascade');
            $table->foreign('violation_id')->references('id')->on('violations')->onDelete('cascade');

            // Add unique index if required
            $table->unique(['student_id_number', 'violation_id'], 'student_violation_unique');
        });
    }
}