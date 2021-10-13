<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'status' , 'tell'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function roles()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function channels()
    {
        return $this->hasMany('App\Channel');
    }

    public function class()
    {
        return $this->hasMany('App\Classes');
    }

    public function arm_Agahi()
    {
        return $this->hasMany('App\ArmAgahi');
    }

    public function box_types()
    {
        return $this->hasMany('App\Box_Type');
    }

    public function cast()
    {
        return $this->hasMany('App\Cast');
    }

    public function product()
    {
        return $this->hasMany('App\Product');
    }

    public function title()
    {
        return $this->hasMany('App\Title');
    }

    public function owner()
    {
        return $this->hasMany('App\Owner');
    }

    public function adver_type()
    {
        return $this->hasMany('App\Adver_Type');
    }

    public function adver_type_coef()
    {
        return $this->hasMany('App\Adver_Type_Coef');
    }

    public function box_prog_group()
    {
        return $this->hasMany('App\Box_Prog_Group');
    }

    public function hasAnyRole($roles)
    {
        return $this->roles()->whereIn('permissions.permission_name',$roles)->first();
    }

    public function hasRole($role)
    {
        return $this->roles()->where('permissions.permission_name',$role)->first();
    }
    

}

