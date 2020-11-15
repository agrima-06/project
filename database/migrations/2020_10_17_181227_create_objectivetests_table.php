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
            $table->integer('user_id');
            $table->string('title'); 
            $table->string('keywords')->nullable(); 
            $table->string('institute'); 
            $table->string('exam'); 
            $table->enum('level', [1,2,3]); //1->Easy, 2-Medium, 3- Hard
            $table->integer('duration');
            $table->boolean('public')->defaul(0);
            //1 is for Shared with my Students I teach, if 1 populate class list in testshared table
            //2 is for public view
            $table->boolean('promotion')->defaul(0);//This is only when Public View is set(AUTO ON)       
            $table->boolean('published')->defaul(0); 
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
