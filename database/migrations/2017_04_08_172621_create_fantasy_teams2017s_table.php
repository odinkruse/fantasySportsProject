<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFantasyTeams2017sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fantasy_teams2017s', function (Blueprint $table) {
            $table->integer('teamNo');
            $table->string('teamMembers');
            $table->integer('firstThirdPoints');
            $table->integer('secondThirdPoints');
            $table->integer('thirdThirdPoints');
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
        Schema::dropIfExists('fantasy_teams2017s');
    }
}
