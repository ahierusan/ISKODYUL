<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('faculty_availabilities', function (Blueprint $table) {
            $table->string('google_event_id')->nullable();
        });
    }

    public function down()
    {
        Schema::table('faculty_availabilities', function (Blueprint $table) {
            $table->dropColumn('google_event_id');
        });
    }
};