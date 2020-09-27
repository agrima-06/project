<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubjectTeacherTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Do Not Delete  Give This default option to teacher. //D/e/let this table in future. This Table can be used to store teacher wise details if school staff searches subject wise teacher in school this table will be usefull. howevr it can be deleted. 
        Schema::create('subject_teacher', function (Blueprint $table) {
            $table->id();
            $table->integer('subject_id');
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
        Schema::dropIfExists('subject_teacher');
    }
}
