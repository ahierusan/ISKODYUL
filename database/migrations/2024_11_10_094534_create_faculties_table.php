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
        Schema::create('faculties', function (Blueprint $table) {
            $table->id();
             $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('first_name');
            $table->string('last_name');
            $table->foreignId('college_department_id');
            $table->string('department');
            $table->string('fb_link')->nullable();
            $table->string('bldg_no');
            $table->json('inquiry_categories')->nullable(); 
            $table->timestamps();
        });
    }

    public function down()
{
    Schema::table('faculties', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
    });

    Schema::dropIfExists('faculties');
}


};
