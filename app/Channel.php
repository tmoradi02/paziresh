<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['channel_name' , 'degree' , 'kind' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function arm_Agahi()
    {
        return $this->belongsToMany('App\ArmAgahi');
    }

    public function tariff()
    {
        return $this->belongsToMany('App\Tariff');
    }
    

}
