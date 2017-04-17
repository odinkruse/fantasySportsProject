<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRaceList2017sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('race_list2017s', function (Blueprint $table) {
            $table->uuid('id');
            $table->increments('raceNo');
            $table->string('name');
            $table->string('track');
            $table->integer('laps');
            $table->date('raceDate');
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
        Schema::dropIfExists('race_list2017s');
    }
}
