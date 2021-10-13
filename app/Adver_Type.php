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
        // ST Doc 1400-07-10 برای این آیدی پاس دادیم که در برنامه دنبال جدول 
        // 'adver_type_id'   آیدی واسط دو جدول
        // adver_types_Coef
        // میگررد و چون پیدا نمیکند ارور میدهد
        return $this->hasMany('App\Adver_Type_Coef' , 'adver_type_id');
    }
    
}
