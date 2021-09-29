<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    protected $fillable = ['cast' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }
    
}
