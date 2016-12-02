<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PokerSeason extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'date',
    ];

    public function games()
    {
        return $this->HasMany('App\PokerGame');
    }
}
