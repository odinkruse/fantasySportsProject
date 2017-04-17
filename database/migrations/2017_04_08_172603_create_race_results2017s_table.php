<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceResults2017sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_results2017s', function (Blueprint $table) {
            $table->uuid('raceID');
            $table->integer('position');
            $table->integer('carNo');
            $table->string('driver');
            $table->integer('startPos');
            $table->integer('lapsComplete');
            $table->integer('lapsLead');
            $table->string('status');
            $table->integer('points');
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
        Schema::dropIfExists('race_results2017s');
    }
}
