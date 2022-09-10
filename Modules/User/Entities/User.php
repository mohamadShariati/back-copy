<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticable;
use Modules\Role\Entities\Role;

class User extends Authenticable
{
    use HasFactory,HasApiTokens,SoftDeletes;

    protected $fillable = ['user_name','password','email','mobile','first_name','last_name','status',]; 


    
    protected static function newFactory()
    {
        // return \Modules\User\Database\factories\UserFactory::new();
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
}
