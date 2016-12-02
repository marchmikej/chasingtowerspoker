<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokerGameFinishesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poker_game_finishes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poker_game_id'); 
            $table->integer('place'); 
            $table->integer('knocked_out_by_id'); 
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
        Schema::drop('poker_game_finishes');
    }
}
