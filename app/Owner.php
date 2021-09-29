<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    protected $fillable =['owner' , 'manager_owner' , 'tell_owner' , 'fax_owner' , 'email_owner' , 'address_owner' , 'kind_group' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');

    }

    
}

