<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box_Type extends Model
{
    protected $table = 'Box_Type';

    protected $fillable = ['box_type' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
