@extends('admin.maindesign')
<base href="/public">
@section('order_details')

<h2>Order Details for ID: {{ $order->id }}</h2>
<p>Customer Phone: {{ $order->receiver_phone }}</p>

<table>
    <thead>
        <tr>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Name</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Quantity</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Subtotal</th>
        </tr>
    </thead>
    <tbody>
        @foreach($order_items as $item)
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->product->product_title }}</td>
            <td style="padding: 8px; border: 1px solid #ddd;">{{ $item->quantity }}</td>
            <td style="padding: 8px; border: 1px solid #ddd;">Rs.{{ $item->product_price }}</td>
            <td style="padding: 8px; border: 1px solid #ddd;">Rs.{{ $item->total_price }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
<h2>Total:Rs. {{ $order->total_price }}</h2>
@endsection