<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
   protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'product_price',
        'total_price', 
    ];
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }
}
