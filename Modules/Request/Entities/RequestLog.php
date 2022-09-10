<?php

namespace Modules\Request\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;


class RequestLog extends Model
{
    use HasFactory,softDeletes;

    protected $fillable = ['request_id','subject','description','status','create_user'];
    
    protected static function newFactory()
    {
        // return \Modules\Request\Database\factories\RequestLogFactory::new();
    }
}
