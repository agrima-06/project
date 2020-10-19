<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivetestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectivetests', function (Blueprint $table) {
            $table->id();
           // $table->integer('subject_id')->nullable();
           // $table->integer('section_id')->nullable();
           // $table->integer('topic_id')->nullable();
           // $table->integer('sclass_id')->nullable();
//$table->String('Title')->nullable();
           // $table->boolean('open')->nullable(); //Test is available for all ? if yes your name will be promted
            $table->json('question');
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
        Schema::dropIfExists('objectivetests');
    }
}
