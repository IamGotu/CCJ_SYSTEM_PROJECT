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
    Schema::create('complaints', function (Blueprint $table) {
        $table->id();
        $table->string('student_id_number');
        $table->string('student_name');
        $table->string('year_level');
        $table->string('complainant_name');
        $table->string('complainant_position');
        $table->string('complainant_contact');
        $table->date('incident_date');
        $table->time('incident_time');
        $table->string('incident_location');
        $table->text('complaint_details');
        $table->string('violation_type');
        $table->boolean('minor_offense')->nullable();
        $table->boolean('major_offense')->nullable();
        $table->text('previous_incidents')->nullable();
        $table->text('action_taken')->nullable();
        $table->text('requested_action')->nullable();
        $table->timestamps();

        // Add the foreign key constraint
        $table->foreign('student_id_number')->references('student_id_number')->on('students')->onDelete('cascade');
    });
}
};
