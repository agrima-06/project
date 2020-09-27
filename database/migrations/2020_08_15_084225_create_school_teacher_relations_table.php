<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolTeacherRelationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('school_teacher_relations', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id');
            $table->integer('sclass_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('teacher_id')->nullable();            
            $table->boolean('classteacher')->default(0);
            $table->boolean('approved')->default(0);

            //This approval to be given by schoolstaff/ Staff or Admin, Request can be made by the school Teacher only.
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
        Schema::dropIfExists('school_teacher_relations');
    }
}
