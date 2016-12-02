<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePokerGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poker_games', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('poker_season_id'); 
            $table->integer('poker_game_type_id'); 
            $table->date('date');
            $table->string('location');
            $table->integer('host_id'); 
            $table->integer('expenses');
            $table->integer('buyin');
            $table->integer('knockout_payment');   
            $table->integer('payout1'); 
            $table->integer('payout2');
            $table->integer('payout3');
            $table->integer('payout4');
            $table->integer('payout5');
            $table->integer('payout6');     
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
        Schema::drop('poker_games');
    }
}
