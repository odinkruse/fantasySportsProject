<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_results', function (Blueprint $table) {
            $table->integer('raceId')->unsigned();
            $table->integer('teamNumber')->unsigned();
            $table->integer('carId')->unsigned();
            $table->integer('driverId')->unsigned();
            $table->integer('position');
            $table->integer('points');
            $table->timestamps();

            $table->foreign('raceId')->references('id')->on('races');
            $table->foreign('teamNumber')->references('number')->on('teams');
            $table->foreign('carId')->references('id')->on('cars');
            $table->foreign('driverId')->references('id')->on('drivers');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('race_results');
    }
}
