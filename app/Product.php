<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable =[ 'product' ,'cast_id' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function cast()
    {
        return $this->belongsToMany('App\Cast');
    }

}


