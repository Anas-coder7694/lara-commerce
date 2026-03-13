@extends('admin.maindesign')
<base href="/public">
@section('update_product')

@if(session('product_message'))
<div class="mb-4 bg green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
    {{ session('product_message') }}
</div>
@endif

<div class="container-fluid">
   
    <form action="{{ route('admin.postupdateproduct',$product->id) }}" method="post" enctype="multipart/form-data">
         @csrf
        <input type="text" name="product_title"  value="{{ $product->product_title }}"> <br>
        <textarea name="product_description" >
           {{ $product->product_description }}
        </textarea><br>
        <input type="number" name="product_quantity"  value="{{ $product->product_price }}"><br>
        <input type="number" name="product_price"  value="{{ $product->product_quantity }}"><br>
        <img style="width:100px;" src="{{ asset('products/'.$product->product_image) }}"> <label></label> Old Image </label>
        <input type="file" name="product_image" ><label >Add new Image here</label>
        <h1>{{$product->category}}</h1> <label for="">old category</label>
        <select name="product_category">
        @foreach($categories as $category)
            <option value="{{$category->category}}" >{{$category->category}}</option>   
        @endforeach
        </select><label for="">select a category</label><br>
        <input type="submit" name="submit" value="Add Product">
    </form>
</div>
@endsection