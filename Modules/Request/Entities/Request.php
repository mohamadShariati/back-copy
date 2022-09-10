<?php

namespace Modules\Request\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class Request extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['request_user','request_date','base_product_id','subject','description','priority','status','complete_user','complete_date','create_user','update_user'];
    
    protected static function newFactory()
    {
        // return \Modules\Request\Database\factories\RequestFactory::new();
    }
}
