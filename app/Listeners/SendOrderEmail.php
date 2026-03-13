<?php
namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderConfirmedMail;

class SendOrderEmail
{
    public function handle(OrderPlaced $event): void
    {
        $items = OrderItem::where('order_id', $event->order->id)->get();
        Mail::to($event->order->user->email)->send(new OrderConfirmedMail($event->order, $items));
    }
}