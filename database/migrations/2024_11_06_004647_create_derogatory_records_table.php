<?php

// database/migrations/xxxx_xx_xx_xxxxxx_create_derogatory_records_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDerogatoryRecordsTable extends Migration
{
    public function up()
    {
        Schema::create('derogatory_records', function (Blueprint $table) {
            $table->id();
            $table->string('student_number')->unique();
            $table->string('last_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->year('year_graduated');
            
            // Derogatory record details
            $table->string('violation')->nullable();
            $table->string('action_taken')->nullable();
            $table->boolean('settled')->default(false); // true for "yes" and false for "no"
            $table->enum('sanction', ['suspension', 'expulsion', 'verbal_warning', 'written_warning', 'others'])->nullable();

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('derogatory_records');
    }
}
