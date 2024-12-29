<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $fillable = [
        'pay_price',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
