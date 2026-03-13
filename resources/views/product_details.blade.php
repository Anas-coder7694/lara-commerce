

@extends('maindesign')
<base href="/public">@if(session('cart_message'))
<div class="mb-4 bg green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
    {{ session('cart_message') }}
</div>
@endif
@section('product_detail')



<div class="container mt-5 mb-5">
    <div class="row">

        <!-- Product Image -->
        <div class="col-md-6 text-center">
            <img src="{{ asset('products/'.$product->product_image) }}" 
                 alt="{{ $product->product_title }}" 
                 class="img-fluid rounded shadow"
                 style="max-height: 400px;">
        </div>

        <!-- Product Details -->
        <div class="col-md-6">
            <h2 class="mb-3">{{ $product->product_title }}</h2>

            <h4 class="text-success mb-3">
                ${{ number_format($product->product_price, 2) }}
            </h4>

            <p class="mb-3">
                <strong>Category:</strong> 
                {{ $product->product_category }}
            </p>

            <p class="mb-3">
                <strong>Available Quantity:</strong> 
                 {{ session("product_stock_{$product->id}", $product->product_quantity) }}
            </p>

            <hr>

            <p>
                {{ $product->product_description }}
            </p>

            <hr>
            @if ($available_stock>0)
                <a href="{{ route( 'add_to_cart',$product->id) }}"> Add to Cart</a>
            @else
                <span>Out of stock</span>
            @endif
            
            

        </div>

    </div>
</div>

@endsection