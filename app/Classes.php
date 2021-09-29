<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = ['class_name' , 'user_id' ];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
