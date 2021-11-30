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

    public function tariff()
    {
        return $this->hasMany('App\Tariff');
    }

    public function channels()  // ST DOC 1400-09-07 اضافه نمودن ریلیشن شبکه به جدول طبقه
    {
        return $this->hasMany('App\Channel');
    }

}
