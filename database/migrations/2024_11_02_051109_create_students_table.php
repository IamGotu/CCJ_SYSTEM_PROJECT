<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('student_id_number')->unique();
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('suffix')->nullable();
            $table->date('birthdate');
            $table->string('purok')->nullable();
            $table->string('street_num')->nullable();
            $table->string('street_name')->nullable();
            $table->string('barangay')->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('postal_num')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('guardian_name')->nullable();
            $table->string('father_contact')->nullable();
            $table->string('mother_contact')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->string('school_year')->nullable();
            $table->string('year_level');
            $table->date('graduation_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}