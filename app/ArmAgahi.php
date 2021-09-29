<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Hekmatinasser\Verta\Verta;
use App\Options\ChangeDateOptions;

class ArmAgahi extends Model
{
    use ChangeDateOptions;
    // نباید ضریب صفر ثبت کند
    protected $fillable = ['channel_id', 'coef', 'from_date', 'to_date', 'user_id'];

    protected $table = 'arm_agahi' ;

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function channels()
    {
        return $this->hasMany('App\Channel');
    }

    // public function getFromDateAttribute($value)
    // {
    //     $date = explode('-' , $value);
    //     $date = Verta::getJalali($date[0],$date[1],$date[2]);
    //     $date = implode('/' , $date);
    //     return $date;
    // }

    // public function setFromDateAttribute($value)
    // {
    //     $date = explode('/',$value);
    //     $date = Verta::getGregorian($date[0],$date[1],$date[2]);
    //     $date = implode('-',$date);
    //     return $date;
    // }

}

