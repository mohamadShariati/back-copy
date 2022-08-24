<?php

namespace Modules\BaseProduct\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class BaseProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [];
    
    protected static function newFactory()
    {
        // return \Modules\BaseProduct\Database\factories\BaseProductFactory::new();
    }
}
