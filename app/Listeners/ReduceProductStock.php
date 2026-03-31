<?php
namespace App\Listeners;

use App\Events\OrderPlaced;
use App\Models\OrderItem;

class ReduceProductStock
{
    public function handle(OrderPlaced $event): void
{
    foreach ($event->cart as $cart_item) {
        // 1. Reduce Stock
        $product = $cart_item->product;
        if ($product) {
            $product->decrement('product_quantity', $cart_item->quantity);
        }

        // 2. SAVE THE ITEM (This was likely missing or failing)
        OrderItem::create([
            'order_id'      => $event->order->id, // The ID of the order we just made
            'product_id'    => $cart_item->product_id,
            'quantity'      => $cart_item->quantity,
            'product_price' => $product->product_price ?? 0,
            'total_price'   => ($product->product_price ?? 0) * $cart_item->quantity,
        ]);
    }
}
}