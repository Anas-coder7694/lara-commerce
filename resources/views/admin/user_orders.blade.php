@extends('admin.maindesign')
<base href="/public">
@section('user_order')

<div class="container mt-5">

    <h2 class="mb-4 text-center">
        Order History of {{ $user->name }}
    </h2>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>Order ID</th>
                <th>Product</th>
                
                <th>Status</th>
                <th>Date</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->product->product_title }}</td>
                
                <td>{{ $order->status }}</td>
                <td>{{ $order->created_at }}</td>
            </tr>
            @endforeach
            
        </tbody>
    </table>

</div>

@endsection