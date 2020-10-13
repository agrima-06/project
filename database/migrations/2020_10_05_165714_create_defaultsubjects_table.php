<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDefaultsubjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        //This Table Store Data of Default Subjects as per Boards and classes. 
        Schema::create('defaultsubjects', function (Blueprint $table) {
            $table->id();
            $table->integer('sclass_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->enum('board', ['CBSE', 'ICSE', 'UPboard', 'CGBoard', 'MPBoard']);
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
        Schema::dropIfExists('defaultsubjects');
    }
}
