<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interns', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->integer('age');
            $table->text('address');
            $table->string('guardian');
            $table->string('guardian_contact');
            $table->string('roster_number')->unique();
            $table->json('documents')->nullable();
            $table->date('internship_start_date')->nullable();
            $table->date('internship_end_date')->nullable();
            $table->string('department')->nullable();
            $table->string('supervisor')->nullable();
            $table->integer('required_hours')->nullable();
            $table->integer('completed_hours')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interns');
    }
};