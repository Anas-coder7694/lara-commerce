@extends('admin.maindesign')

@section('view_orders')

<table>
    <thead>
        <tr style="text-align: center;background-color: #303833; color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">Customer Name</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Address</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Phone</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Price</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Image</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
            
        </tr>
    </thead>

    <tbody>

@foreach ($orders as $order)

    @foreach ($order->items as $item)

        <tr style="text-align: center;">

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ optional($order->user)->name }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->receiver_address }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->receiver_phone }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ optional($item->product)->product_title }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $item->product_price }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                <img style="width:80px;"
                     src="{{ asset('products/'.optional($item->product)->product_image) }}">
            </td>

            <td style="padding: 12px;">
                <form action="{{ route('admin.change_status',$order->id) }}" method="post">
                    @csrf
                    <select name="status">
                        <option value="delivered" {{ $order->status=='delivered'?'selected':'' }}>Delivered</option>
                        <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                    </select>
                    <input type="submit" value="submit" onclick="return confirm('Are you sure')">
                </form>
            </td>

            

        </tr>

    @endforeach

@endforeach

    </tbody>
</table>

@endsection