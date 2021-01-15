<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectivetestpromotionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('objectivetestpromotions', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('objectivetest_id');
            $table->string('brandName');
            $table->string('Address');
            $table->string('Logo'); //Image URL
            $table->string('website');
            $table->string('contactNo');
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
        Schema::dropIfExists('objectivetestpromotions');
    }
}
