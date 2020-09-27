<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSclassTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //Do not delete //D/e/let this table in future. This table can be used to save default data in which teacher teaches. It can be deleted. 
        Schema::create('sclass_teacher', function (Blueprint $table) {
            $table->id();
            $table->integer('sclass_id');
            $table->integer('teacher_id');
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
        Schema::dropIfExists('sclass_teacher');
    }
}
