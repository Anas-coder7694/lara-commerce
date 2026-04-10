@extends('vendor.maindesign') {{-- or your main layout --}}

@section('orders')

<div class="container mt-4">

    <h2 style="margin-bottom:20px;">📦 Vendor Orders</h2>

    @if($order_items->isEmpty())
        <div style="padding:20px; background:#f8d7da; color:#721c24;">
            No orders found.
        </div>
    @else

    <table style="width:100%; border-collapse:collapse; text-align:center;">
        <thead style="background-color:#343a40; color:white;">
            <tr>
                <th style="padding:10px; border:1px solid #ddd;">Order ID</th>
                <th style="padding:10px; border:1px solid #ddd;">Product</th>
                <th style="padding:10px; border:1px solid #ddd;">Quantity</th>
                <th style="padding:10px; border:1px solid #ddd;">Price</th>
                <th style="padding:10px; border:1px solid #ddd;">Customer Name</th>
                <th style="padding:10px; border:1px solid #ddd;">Address</th>
                <th style="padding:10px; border:1px solid #ddd;">Status</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order_items as $item)
            <tr>
                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->order->id ?? 'N/A' }}
                </td>

                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->product->product_title ?? 'N/A' }}
                </td>

                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->quantity }}
                </td>

                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->price }}
                </td>

                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->order->name ?? 'N/A' }}
                </td>

                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->order->receiver_address ?? 'N/A' }}
                </td>

                <td style="padding:10px; border:1px solid #ddd;">
                    {{ $item->order->status ?? 'Pending' }}
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @endif

</div>

@endsection