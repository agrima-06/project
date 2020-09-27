<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('school_id')->nullable();
            $table->integer('contactNo')->nullable();
            $table->string('DOB')->nullable();
            $table->string('Qualification')->nullable();
            $table->boolean('approved')->default(0);
            //This approval to be given by schoolstaff/ Staff or Admin, Request can be made by the Teacher only.

            $table->timestamps();
           });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
