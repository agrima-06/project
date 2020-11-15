<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestresultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('testresults', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('objectivetest_id');
            $table->integer('liveScore')->nullable();
            $table->integer('liveRank')->nullable();
            $table->integer('oflineScore')->nullable();
           // $table->integer('currentRank')->nullable();
            $table->integer('answered')->nullable();
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
        Schema::dropIfExists('testresults');
    }
}
