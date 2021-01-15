<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestquestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testquestions', function (Blueprint $table) {
            $table->id();
            $table->integer('objectivetest_id');
            $table->string('subject');
            $table->integer('marks'); //Marks for each question
            $table->integer('negativeMarks');
            $table->integer('noOfQuestions');
            $table->json('question')->nullable();
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
        Schema::dropIfExists('testquestions');
    }
}
