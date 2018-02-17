<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamSeasonStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_season_standings', function (Blueprint $table) {
            $table->integer('teamNumber')->unsigned();
            $table->integer('seasonId')->unsigned();
            $table->integer('points')->default(0);

            $table->foreign('teamNumber')->references('number')->on('teams');
            $table->foreign('seasonId')->references('id')->on('seasons');
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
        Schema::dropIfExists('team_season_standings');
    }
}
