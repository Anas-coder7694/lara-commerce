<?php
namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\OrderItem;

class ReduceProductStock
{
    public function handle(OrderPlaced $event): void
    {
        foreach ($event->cart as $cart_item) {
            $product = $cart_item->product;
            if ($product) {
                // Use decrement for atomic database updates
                $product->decrement('product_quantity', $cart_item->quantity);
                
                if ($product->product_quantity < 0) {
                    $product->update(['product_quantity' => 0]);
                }
            }

            OrderItem::create([
                'order_id'      => $event->order->id,
                'product_id'    => $cart_item->product_id,
                'quantity'      => $cart_item->quantity,
                'product_price' => $product->product_price ?? 0,
                'total_price'   => ($product->product_price ?? 0) * $cart_item->quantity,
            ]);
        }
    }
}