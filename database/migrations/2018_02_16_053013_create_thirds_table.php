<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateThirdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thirds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('seasonId')->unsigned();
            $table->integer('thirdNo');
            $table->string('name')->nullable();

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
        Schema::dropIfExists('thirds');
    }
}
