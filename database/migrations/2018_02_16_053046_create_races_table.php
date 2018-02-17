<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('races', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('thirdId')->unsigned();
            $table->integer('trackId')->unsigned();
            $table->string('name');
            $table->integer('raceNo');

            $table->foreign('trackId')->references('id')->on('tracks');
            $table->foreign('thirdId')->references('id')->on('thirds');
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
        Schema::dropIfExists('races');
    }
}
