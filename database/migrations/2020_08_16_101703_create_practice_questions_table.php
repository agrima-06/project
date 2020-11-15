<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePracticeQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() 
    {
        Schema::create('practice_questions', function (Blueprint $table) {
            $table->id();
            $table->integer('exam')->nullable();
            //Questions for different board shud be seperate in exam category.
            //Board Can be used for different Streams :- Btech MECH, Computer, 
            $table->integer('subject_id')->nullable();
            $table->integer('sclass_id')->nullable();
            $table->integer('topic_id')->nullable();
            // $table->string('sub_topic')->nullable();
            $table->longText('question')->unique();
            $table->integer('Level')->nullable();        
            // $table->string('optionA')->nullable();
            // $table->string('optionB')->nullable();
            // $table->string('optionC')->nullable();
            // $table->string('optionD')->nullable();
            // $table->string('optionE')->nullable();
            // $table->enum('correct_option', ['A', 'B', 'C', 'D', 'E']);    
            // $table->string('hint')->nullable();
            // $table->longText('explanation')->nullable();            
            $table->string('file_url')->nullable();
            $table->integer('answer_id');//
            $table->integer('user_id')->nullable();
            $table->boolean('approved')->default(0);
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
        Schema::dropIfExists('practice_questions');
    }
}
