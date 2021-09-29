<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    protected $table= 'permissions';

    protected $fillable =['permission_name'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

}
