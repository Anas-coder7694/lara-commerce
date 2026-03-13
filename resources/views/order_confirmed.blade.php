<h2>Order Confirmed</h2>

<p>Your order has been placed successfully.</p>

<p><strong>Order ID:</strong> {{ $order->id }}</p>
<p><strong>Shipping Address:</strong> {{ $order->receiver_address }}</p>
<p><strong>Phone:</strong> {{ $order->receiver_phone }}</p>

<h3>Ordered Products:</h3>

<table border="1" cellpadding="10">
<tr>
    <th>Product</th>
    <th>Quantity</th>
    <th>Price</th>
</tr>

@foreach($items as $item)
<tr>
    <td>{{ $item->product->product_title }}</td>
    <td>{{ $item->quantity }}</td>
    <td>{{ $item->product_price }}</td>
</tr>
@endforeach

</table>

<p><strong>Total:</strong> {{ $order->total_price }}</p>