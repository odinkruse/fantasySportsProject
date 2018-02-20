<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamThirdStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_third_standings', function (Blueprint $table) {
            $table->integer('teamNumber')->unsigned();
            $table->integer('third_id')->unsigned();
            $table->integer('points')->default(0);

            $table->foreign('teamNumber')->references('number')->on('teams');
            $table->foreign('third_id')->references('id')->on('thirds');
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
        Schema::dropIfExists('team_third_standings');
    }
}
