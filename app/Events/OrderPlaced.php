<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets; 
use Illuminate\Queue\SerializesModels;

class OrderPlaced
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $order;
    public $cart;

    /**
     * Create a new event instance.
     */
    public function __construct($order, $cart)
    {
        $this->order = $order;
        $this->cart = $cart;
    }
}