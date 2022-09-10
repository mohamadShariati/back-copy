<?php

namespace Modules\Role\Entities;

use Modules\User\Entities\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['name','attribute_name','status'];
    
    protected static function newFactory()
    {
        // return \Modules\Role\Database\factories\RoleFactory::new();
    }

    public function users(){
        return $this->belongsToMany(User::class);
    }
}
