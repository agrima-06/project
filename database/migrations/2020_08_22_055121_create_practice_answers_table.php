<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeAnswersTable extends Migration 
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_answers', function (Blueprint $table) {
            $table->id();
            $table->string('optionA')->nullable();
            $table->string('optionA_Imgurl')->nullable();
            $table->string('optionB')->nullable();
            $table->string('optionB_Imgurl')->nullable();
            $table->string('optionC')->nullable();
            $table->string('optionC_Imgurl')->nullable();
            $table->string('optionD')->nullable();
            $table->string('optionD_Imgurl')->nullable();
            $table->string('optionE')->nullable();
            $table->string('optionE_Imgurl')->nullable();
            $table->enum('correct_option', ['A', 'B', 'C', 'D', 'E']);    
            $table->string('hint')->nullable();
            $table->longText('explanation')->nullable();
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
        Schema::dropIfExists('practice_answers');
    }
}
