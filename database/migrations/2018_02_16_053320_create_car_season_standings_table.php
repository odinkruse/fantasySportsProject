<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarSeasonStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_season_standings', function (Blueprint $table) {
            $table->integer('car_id')->unsigned();
            $table->integer('season_id')->unsigned();
            $table->integer('points')->default(0);

            $table->foreign('car_id')->references('id')->on('cars');
            $table->foreign('season_id')->references('id')->on('seasons');
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
        Schema::dropIfExists('car_season_standings');
    }
}
