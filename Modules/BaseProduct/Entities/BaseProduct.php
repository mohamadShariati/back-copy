<?php

namespace Modules\BaseProduct\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Contract\Entities\Contract;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BaseProduct extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = ['name','status','create_user'];
    
    protected static function newFactory()
    {
        // return \Modules\BaseProduct\Database\factories\BaseProductFactory::new();
    }

    public function contracts()
    {
        return $this->belongsToMany(Contract::class);
    }
}
