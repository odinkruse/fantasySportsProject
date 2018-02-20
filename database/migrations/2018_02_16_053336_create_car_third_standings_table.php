<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarThirdStandingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_third_standings', function (Blueprint $table) {
            $table->integer('car_id')->unsigned();
            $table->integer('third_id')->unsigned();
            $table->integer('points')->default(0);

            $table->foreign('car_id')->references('id')->on('cars');
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
        Schema::dropIfExists('car_third_standings');
    }
}
