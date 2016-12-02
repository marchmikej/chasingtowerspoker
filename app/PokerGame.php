<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokerGame extends Model
{
    public function finishes()
    {
        return $this->HasMany('App\PokerGameFinish');
    }

    public function pokerGameType()
    {
    	return $this->belongsTo('App\PokerGameType');
    }

    public function host()
    {
    	return User::findorfail($this->host_id);
    }
}
