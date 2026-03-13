@extends('admin.maindesign')


@section('viewcategory')

<table style="width: 100%; border-collapse: collapse; margin-top: 20px; font-family: Arial, sans-serif;">
    <thead>
        <tr style="text-align: center;background-color: #16a34a; color: white;">
            <th style="padding: 10px; border: 1px solid #ddd;">ID</th>
            <th style="padding: 10px; border: 1px solid #ddd;" colspan="3">Category Name</th>
        </tr>
    </thead>
    <tbody>
    @foreach ($categories as $category)
        <tr style="text-align: center;">
            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $category->id }}
            </td>
            <td style="padding: 8px; border: 1px solid #ddd;">
                {{ $category->category }}
            </td>
            <td style="padding: 8px; border: 1px solid #ddd; color: green;">
                  
                <a href="{{route('admin.updatecategory',$category->id)}}">Update</a>
            </td>
            <td style="padding: 8px; border: 1px solid #ddd;color: red;">
                 <a href="{{route('admin.deletecategory',$category->id)}}" onclick="confirm('Are you sure')">Delete</a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>


@endsection