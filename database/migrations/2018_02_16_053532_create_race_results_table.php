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
            $table->integer('race_id')->unsigned();
            $table->integer('teamNumber')->unsigned();
            $table->integer('car_id')->unsigned();
            $table->integer('driver_id')->unsigned();
            $table->integer('position');
            $table->integer('points');
            $table->timestamps();

            $table->foreign('race_id')->references('id')->on('races');
            $table->foreign('teamNumber')->references('number')->on('teams');
            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('driver_id')->references('id')->on('drivers');

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
