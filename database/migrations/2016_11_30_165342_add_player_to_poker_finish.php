<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPlayerToPokerFinish extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('poker_game_finishes', function (Blueprint $table) {
            $table->integer('user_id'); 
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('poker_game_finishes', function(Blueprint $table) {
            $table->dropColumn('user_id');
        });
    }
}
