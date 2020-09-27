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
            $table->string('sclass_id')->nullable();
            $table->string('topic')->nullable();
            $table->string('subject_id')->nullable();
            $table->longText('content')->nullable();
            $table->string('hint')->nullable();
            $table->integer('school_id')->nullable();
            $table->integer('user_id')->nullable(); // This id will always be of Teacher
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
