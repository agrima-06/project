<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSclassSubjectTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//We Need This Table Dont Delete\/ This Table will help staff to give Default Subjects options for particular class. 
        Schema::create('sclass_subject', function (Blueprint $table) {
            $table->id();
            $table->integer('sclass_id');
            $table->integer('subject_id');
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
        Schema::dropIfExists('sclass_subject');
    }
}
