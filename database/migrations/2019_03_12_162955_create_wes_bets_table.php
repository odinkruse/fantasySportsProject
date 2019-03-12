<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWesBetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wes_bets', function (Blueprint $table) {
            $table->integer('season_id')->unsigned();
            $table->string('name');
            $table->integer('car_id')->unsigned();
            $table->integer('wins')->unsigned();
            $table->integer('points')->unsigned();
            $table->timestamps();

            $table->foreign('season_id')->references('id')->on('seasons');
            $table->foreign('car_id')->references('id')->on('cars');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wes_bets');
    }
}
