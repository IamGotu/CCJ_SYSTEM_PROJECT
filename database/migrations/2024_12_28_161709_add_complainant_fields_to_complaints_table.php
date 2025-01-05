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
        Schema::table('complaints', function (Blueprint $table) {
            $table->string('complainant_type')->after('complainant_contact');
            $table->string('complainant_student_id')->nullable()->after('complainant_type');
            $table->string('complainant_email')->after('complainant_student_id');
            $table->string('complainant_contact_number')->after('complainant_email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('complaints', function (Blueprint $table) {
            $table->dropColumn('complainant_type');
            $table->dropColumn('complainant_student_id');
            $table->dropColumn('complainant_email');
            $table->dropColumn('complainant_contact_number');
        });
    }
};
