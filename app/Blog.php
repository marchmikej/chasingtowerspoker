<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'body',
    ];

     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
