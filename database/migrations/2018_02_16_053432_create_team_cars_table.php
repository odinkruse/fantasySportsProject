<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_cars', function (Blueprint $table) {
            $table->integer('teamNumber')->unsigned();
            $table->integer('carId')->unsigned();
            $table->integer('thirdId')->unsigned();

            $table->foreign('teamNumber')->references('number')->on('teams');
            $table->foreign('thirdId')->references('id')->on('thirds');
            $table->foreign('carId')->references('id')->on('cars');
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
        Schema::dropIfExists('team_cars');
    }
}
