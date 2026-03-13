<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\OrderItem;

class Orders extends Model
{
    // Order belongs to a user

    
    protected $fillable = [
        'user_id', 
        'total_price', 
        'status', 
        'receiver_address', 
        'receiver_phone'
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Order has many order items
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}