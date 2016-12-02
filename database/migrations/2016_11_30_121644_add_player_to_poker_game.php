<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayerToPokerGame extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poker_games', function (Blueprint $table) {
            $table->integer('number_of_players'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poker_games', function(Blueprint $table) {
            $table->dropColumn('number_of_players');
        });
    }
}
