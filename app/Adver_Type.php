<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Adver_Type extends Model
{
    protected $table = 'adver_types';

    protected $fillable = ['adver_type' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
    
    public function adver_type_coef()
    {
        return $this->hasMany('App\Adver_Type_Coef');
    }
    
}
