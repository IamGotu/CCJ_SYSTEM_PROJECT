<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // First, let's create a fresh interns table
        Schema::dropIfExists('interns');
        
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->string('student_number');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('year_level');
            $table->string('roster_number')->nullable();
            $table->integer('age')->nullable();
            $table->string('address')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('guardian')->nullable();
            $table->string('guardian_contact')->nullable();
            $table->text('documents')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('interns');
    }
};