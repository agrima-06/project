<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsharedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testshareds', function (Blueprint $table) {
            $table->id();
            $table->integer('objectivetest_id');
            $table->integer('school_id')->nullable();
            $table->integer('sclass_id')->nullable();
            $table->integer('section_id')->nullable();
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
        Schema::dropIfExists('testshareds');
    }
}
