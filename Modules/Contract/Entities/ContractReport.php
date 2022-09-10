<?php

namespace Modules\Contract\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class ContractReport extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['contract_id','description','attribute_name','amount','create_user','send_date','contract_date','status'];
    
    protected static function newFactory()
    {
        // return \Modules\Contract\Database\factories\ContractReportFactory::new();
    }
}
