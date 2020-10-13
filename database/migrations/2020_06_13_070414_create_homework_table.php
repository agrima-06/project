<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomeworkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homework', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id')->nullable();
            $table->integer('sclass_id')->nullable();
            $table->integer('section_id')->nullable();
            $table->integer('subject_id')->nullable();
            $table->integer('topic_id')->nullable();
            $table->string('heading')->nullable();
            $table->longText('content')->nullable();
            $table->string('hint')->nullable();
            $table->integer('teacher_id')->nullable(); // This id will always be of Teacher
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
        Schema::dropIfExists('homework');
    }
}
