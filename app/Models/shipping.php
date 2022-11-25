<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    protected $table = 'shippings';
    protected $fillable = [
        'shipping_code',
        'name',
        'phone',
        'email',
        'ship_from',
        'ship_to',
        'fee_service',
        'weight',
        'height',
        'delivery_status_id',
        'sub_delivery_status_id',
        'latest_change_status',
        'lastest_checkpoint_time',
        'note'
    ];
}
