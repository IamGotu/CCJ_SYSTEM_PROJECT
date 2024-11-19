<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('interns', function (Blueprint $table) {
            // Make these fields nullable
            $table->string('guardian')->nullable()->change();
            $table->string('guardian_contact')->nullable()->change();
            $table->string('roster_number')->nullable()->change();
            $table->string('address')->nullable()->change();
            $table->string('contact_number')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('interns', function (Blueprint $table) {
            // Revert changes
            $table->string('guardian')->nullable(false)->change();
            $table->string('guardian_contact')->nullable(false)->change();
            $table->string('roster_number')->nullable(false)->change();
            $table->string('address')->nullable(false)->change();
            $table->string('contact_number')->nullable(false)->change();
        });
    }
};