<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    protected $fillable = [
        'shipping_code',
        'name',
        'phone',
        'email',
        'ship_from',
        'ship_to',
         'weight',
         'height',
         'delivery_status_id',
         'sub_delivery_status_id',
         'latest_change_status',
         'lastest_checkpoint_time',
         'note'
    ];
}   
