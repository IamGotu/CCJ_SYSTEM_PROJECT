<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerogatoryRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('derogatory_records', function (Blueprint $table) {
            $table->id();
            $table->string('student_id_number'); // Foreign key reference
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('year_level');
            $table->string('school_year');
            $table->enum('enrollment_status', ['enrolled', 'not_enrolled']);
            $table->date('graduation_date')->nullable();
            $table->string('violation')->nullable();
            $table->string('action_taken')->nullable();
            $table->boolean('settled')->default(false);
            $table->enum('sanction', ['suspension', 'expulsion', 'verbal_warning', 'written_warning', 'others'])->nullable();
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('student_id_number')->references('student_id_number')->on('students')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('derogatory_records');
    }
}
