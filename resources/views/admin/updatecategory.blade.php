@extends('admin.maindesign')
<base href="/public">
@section('update_category')

@if(session('category_updated_message'))
<div class="mb-4 bg green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
    {{ session('category_updated_message') }}
</div>
@endif

<div class="container-fluid">
    <form action="{{ route('admin.postupdatecategory',$category->id) }}" method="post">
         @csrf
        <input type="text" name="category" value="{{ $category->category }}">
        <input type="submit" name="submit" value="Update Category">
    </form>
</div>
@endsection