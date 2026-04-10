@extends('admin.maindesign')

@section('view_orders')

<table>
    <thead>
        <tr style="text-align: center;background-color: #303833; color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">Order ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">User ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Reciever Address</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Phone</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Total</th>
            <th style="padding: 10px; border: 1px solid #ddd;" colspan="2">Action</th>
            
        </tr>
    </thead>

    <tbody>

@foreach ($orders as $order)

   

        <tr style="text-align: center;">
            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->id }}
            </td>
            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->user_id }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->receiver_address }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->receiver_phone }}
            </td>

            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $order->total_price }}
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

            <td style="padding: 8px; border: 1px solid #ddd;">
                <a href="{{ route('admin.view_details',$order->id) }}">See details</a>
            </td> 

            

        </tr>

    

@endforeach

    </tbody>
</table>

@endsection