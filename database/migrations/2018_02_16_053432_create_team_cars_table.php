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
            $table->integer('car_id')->unsigned();
            $table->integer('third_id')->unsigned();

            $table->foreign('teamNumber')->references('number')->on('teams');
            $table->foreign('third_id')->references('id')->on('thirds');
            $table->foreign('car_id')->references('id')->on('cars');
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
