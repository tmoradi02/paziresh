<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Options\ChangeDateOptions;

class Adver_Type_Coef extends Model
{
    use ChangeDateOptions;

    protected $table = 'adver_type_coef';

    protected $fillable = ['coef' , 'adver_type_id' , 'from_date' , 'to_date' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function adver_type()
    {
        return $this->belongsToMany('App\Adver_Type');
    } 

} 

