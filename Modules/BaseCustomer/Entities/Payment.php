<?php

namespace Modules\BaseCustomer\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Payment extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['customer_id','amount','date_deposite','create_user','status'];
    
    protected static function newFactory()
    {
        // return \Modules\BaseCustomer\Database\factories\PaymentFactory::new();
    }
}
