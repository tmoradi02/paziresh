<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Options\ChangeDateOptions;
use Hekmatinasser\Verta\Verta;

class Tariff extends Model
{
    use ChangeDateOptions;

    protected $table = 'Tariff';

    protected $fillable = ['channel_id' , 'classes_id' , 'from_date' , 'to_date' , 'box_type_id' , 'price' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function channels()  
    {
        return $this->hasMany('App\Channel');
    }

    public function class()
    {
        return $this->hasMany('App\Classes');
    }

    public function box_type()
    {
        return $this->hasMany('App\Box_Type');
    }

}

