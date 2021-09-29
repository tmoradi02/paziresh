<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Model
{
    public $fillable = ['title' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
