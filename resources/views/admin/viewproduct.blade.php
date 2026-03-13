@extends('admin.maindesign')


@section('viewproduct')
@if(session('deleteproduct_message'))
<div class="mb-4 bg red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
    {{ session('deleteproduct_message') }}
</div>
@endif      
<div class="list inline-item">
                <form id="searchForm" action={{ route('admin.searchproduct') }} method="post">
                    @csrf
                <div class="form-group">
                    <input type="text" name="search" placeholder="What are you searching for...">
                    <button type="submit" class="submit">
                        Search
                    </button>
                </div> 
                </form>
            </div>
<table >
    <thead>
        <tr style="text-align: center;background-color: #303833; color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Title</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Description</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Quantity</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Price</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Image</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Product Category</th>
            <th style="padding: 10px; border: 1px solid #ddd;">Action</th>
           
            

           
        </tr>
    </thead>
    <tbody>
    @foreach ($products as $product)
        <tr style="text-align: center;">
             <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $product->id }}
            </td>
            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $product->product_title }}
            </td>
            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $product->product_description }}
            </td>
             <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $product->product_quantity }}
            </td>
             <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $product->product_price }}
            </td>
             <td style="padding: 8px; border: 1px solid #ddd;">
               
                <img style="width: 100px;" src="{{ asset('products/'.$product->product_image  ) }}" >
            </td>
             <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $product->product_category }}
            </td>
            <td style="padding: 8px; border: 1px solid #ddd; color: green;">
                  
            <a href="{{ route('admin.updateproduct',$product->id) }}" style="color: green;">Update</a>
            <a href="{{ route('admin.deleteproduct',$product->id) }}" style="color: red;" onclick="confirm('Are You Sure?')">Delete</a>
            
            </td>
        </tr>
    @endforeach
    {{ $products->links() }}
    </tbody>
</table>


@endsection