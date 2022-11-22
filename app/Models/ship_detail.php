<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ship_detail extends Model
{
    protected $table = 'ship_details';
    
    protected $fillable = [
        'ship_id',
        'name',
        'code',
        'quantity',
        'price'
    ];

}
