<?php

namespace Modules\BaseCustomer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class BaseCustomer extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['company_name','agent','real_or_legal','province','city','address','tel','mobile','manager_name','create_user','status'];
    
    protected static function newFactory()
    {
        // return \Modules\BaseCustomer\Database\factories\BaseCustomerFactory::new();
    }
}
