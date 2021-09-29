<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Box_Prog_Group extends Model
{
    protected $table = 'box_prog_group';

    protected $fillable = ['prog_group' , 'user_id'];

    public function user()
    {
        return $this->belongsToMany('App\User');
    }
}
