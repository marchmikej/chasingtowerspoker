<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokerGameFinish extends Model
{
     public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function pokerGame()
    {
    	return $this->belongsTo('App\PokerGame');	
    }

    public function knockouts()
    {
    	return PokerGameFinish::where('knocked_out_by_id',$this->user_id)->where('poker_game_id',$this->poker_game_id)->count();
    }

    public function points() 
    {
    	if($this->pokerGame->pokerGameType->id == 1 && $this->place > 0)
    	{
    		return $this->pokerGame->number_of_players - $this->place + 1;
    	} else if($this->pokerGame->pokerGameType->id == 2 && $this->place > 0)
    	{
    		$knockouts = PokerGameFinish::where('knocked_out_by_id',$this->user_id)->where('poker_game_id',$this->poker_game_id)->count();
    		return ($this->pokerGame->number_of_players - $this->place + 1) + ($knockouts*0.5);
    	} else
    	{
    		return 0;
    	}
    }

    public function money() 
    {
    	if($this->pokerGame->pokerGameType->id == 1 && $this->place > 0)
    	{
    		$knockouts = PokerGameFinish::where('knocked_out_by_id',$this->user_id)->where('poker_game_id',$this->poker_game_id)->count();
    		$money = $knockouts * 5;
    		if($this->place==1)
    		{
    			$money = $this->pokerGame->payout1 + $money;
    		} else if($this->place==2)
    		{
    			$money = $this->pokerGame->payout2 + $money;
    		} else if($this->place==3)
    		{
    			$money = $this->pokerGame->payout3 + $money;
    		} else if($this->place==4)
    		{
    			$money = $this->pokerGame->payout4 + $money;
    		} else if($this->place==5)
    		{
    			$money = $this->pokerGame->payout5 + $money;
    		} else if($this->place==6)
    		{
    			$money = $this->pokerGame->payout6 + $money;
    		} 
    		return $money;
    	} else if($this->pokerGame->pokerGameType->id == 2 && $this->place > 0)
    	{
    		$knockouts = PokerGameFinish::where('knocked_out_by_id',$this->user_id)->where('poker_game_id',$this->poker_game_id)->count();
    		$money = $knockouts * 10;
            if($this->place==1)
            {
                $money = $this->pokerGame->payout1 + $money;
            } else if($this->place==2)
            {
                $money = $this->pokerGame->payout2 + $money;
            } else if($this->place==3)
            {
                $money = $this->pokerGame->payout3 + $money;
            } else if($this->place==4)
            {
                $money = $this->pokerGame->payout4 + $money;
            } else if($this->place==5)
            {
                $money = $this->pokerGame->payout5 + $money;
            } else if($this->place==6)
            {
                $money = $this->pokerGame->payout6 + $money;
            } 
            return $money;
    	} else
    	{
    		return 0;
    	}
    }
}
