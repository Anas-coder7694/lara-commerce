@extends('maindesign')

@section('viewcart_products')
    

@if(session('deleteproduct_message'))
<div style="
    margin:20px auto;
    width:80%;
    background-color:#fde2e2;
    border:1px solid #f5c2c7;
    color:#b02a37;
    padding:12px;
    border-radius:6px;
    text-align:center;
    font-weight:bold;
">
    {{ session('deleteproduct_message') }}
</div>
@endif      

<div style="width:90%; margin:40px auto;">
<table style="
    width:100%;
    border-collapse:collapse;
    font-family:Arial, sans-serif;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
">
    <thead>
        <tr style="background-color:#303833; color:white; text-align:center;">
            <th style="padding:12px; border:1px solid #ddd;">Product Title</th>
            <th style="padding:12px; border:1px solid #ddd;">Product Price</th>
            <th style="padding:12px; border:1px solid #ddd;">Product Image</th>
            <th style="padding:12px; border:1px solid #ddd;">Quantity</th>
            <th style="padding:12px; border:1px solid #ddd;">Action</th>
        </tr>
    </thead>
    <tbody>
        @php
        $total=0;
        @endphp
    @foreach ($cart as $cart_item)
        <tr style="text-align:center; background-color:#f9f9f9;">
            
            <td style="padding:10px; border:1px solid #ddd;">
                {{ $cart_item->product->product_title }}
            </td>
           
            <td style="padding:10px; border:1px solid #ddd; font-weight:bold; color:#198754;">
                ${{ $cart_item->product->product_price }}
            </td>

            <td style="padding:10px; border:1px solid #ddd;">
                <img 
                    style="width:90px; height:90px; object-fit:cover; border-radius:6px; border:1px solid #ccc;" 
                    src="{{ asset('products/'.$cart_item->product->product_image) }}">
            </td>
            <td style="padding:10px; border:1px solid #ddd; font-weight:bold; color:#198754;">
                {{ $cart_item->quantity }}  
            </td>

            <td style="padding:10px; border:1px solid #ddd;">
                <a href="{{route('removecartproducts',$cart_item->id)}}" style="
                    background-color:#dc3545;
                    color:white;
                    padding:8px 14px;
                    text-decoration:none;
                    border-radius:5px;
                    font-weight:bold;
                    display:inline-block;
                "
                onclick="return confirm('Are you sure ,you want to delete this item?')";
                >
                    Remove
                </a>
            </td>
        </tr>
        @php
        $total+=  $cart_item->product->product_price *$cart_item->quantity ;
        @endphp
    @endforeach
   <tr style="background-color:#222; color:white;">
    <td colspan="5" style="
        padding:18px;
        text-align:right;
        font-size:20px;
        font-weight:bold;
        letter-spacing:1px;
    ">
        🛒 Total Amount: 
        <span style="color:#00ff88; font-size:22px;">
            Rs.{{ $total }}
        </span>
    </td>
</tr>
    </tbody>
</table>

    @if(session('confirm_order'))
        <div class="mb-4 bg green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
            {{ session('confirm_order') }}
        </div>
    @endif
<form action="{{ route('confirm_order') }}" method="post" class="p-4 shadow rounded bg-light" style="max-width:500px; margin:auto;">
    @csrf

    <div class="mb-3">
        <label class="form-label">Receiver Address</label>
        <input type="text" 
               name="receiver_address" 
               class="form-control" 
               placeholder="Enter your receiver address" 
               required>
    </div>

    <div class="mb-3">
        <label class="form-label">Receiver Phone</label>
        <input type="text" 
               name="receiver_phone" 
               class="form-control" 
               placeholder="Enter your receiver number" 
               required>
    </div>

    <div class="d-flex justify-content-between align-items-center">
        <input type="submit" 
               value="Cash On Delivery" 
               class="btn btn-primary">

        
    </div>
</form>
</div>

@endsection