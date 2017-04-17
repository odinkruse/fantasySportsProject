<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarList2017sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_list2017s', function (Blueprint $table) {
            $table->integer('carNo');
            $table->integer('q1TeamNo');
            $table->integer('q1Price');
            $table->integer('q1draw');
            $table->integer('q1Points');
            $table->integer('q2TeamNo');
            $table->integer('q2Price');
            $table->integer('q2Draw');
            $table->integer('q2Points');
            $table->integer('q3TeamNo');
            $table->integer('q3Price');
            $table->integer('q3Draw');
            $table->integer('q3Points');
            $table->integer('totalPoints');
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
        Schema::dropIfExists('car_list2017s');
    }
}
