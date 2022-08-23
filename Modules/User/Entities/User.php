<?php

namespace Modules\User\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticable;

class User extends Authenticable
{
    use HasFactory,HasApiTokens,SoftDeletes;

    protected $fillable = [];


    
    protected static function newFactory()
    {
        // return \Modules\User\Database\factories\UserFactory::new();
    }
}
