<?php

namespace Modules\Contract\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\BaseProduct\Entities\BaseProduct;
use Illuminate\Database\Eloquent\SoftDeletes; 
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Contract extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['customer_id','mobile','contract_subject','status','start_date','end_date','notification_date','payment_period','amount','description','create_user'];
    
    protected static function newFactory()
    {
        // return \Modules\Contract\Database\factories\ContractFactory::new();
    }

    public function baseproducts()
    {
        return $this->belongsToMany(BaseProduct::class);
    }
}
