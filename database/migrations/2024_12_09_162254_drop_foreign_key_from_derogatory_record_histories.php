<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyFromDerogatoryRecordHistories extends Migration
{
    public function up()
    {
        Schema::table('derogatory_record_histories', function (Blueprint $table) {
            // Replace 'fk_student_id' with your actual foreign key name
            $table->dropForeign(['student_id_number']);
        });
    }

    public function down()
    {
        Schema::table('derogatory_record_histories', function (Blueprint $table) {
            // Re-add foreign key if needed
            $table->foreign('student_id_number')->references('student_id_number')->on('students')->onDelete('cascade');
        });
    }
}