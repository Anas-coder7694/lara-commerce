<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // echo 'here';die;
        // dd($request->getUser());

        $product =Products::all();

        return response()->json($product,200);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {   
       $id=Auth::user()->vendor->id;
       //echo $id; die;
       // echo $request->user()->id;die;
        $request->validate([
            
            'product_title' => 'required|string|max:255',
            'product_description' => 'required|string',
            'product_quantity' => 'required|integer|min:1',
            'product_category' =>'required|exists:categories,category',
            //'product_image' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'product_price' => 'required|numeric|min:0'
        ]);

        if($request->hasFile('product_image')){
               
            $image = $request->file('product_image');

            $imageName = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('products'), $imageName);
        }
;

        $product = Products::create([
            'vendor_id' => $request->user()->vendor->id,
            'product_title' => $request->product_title,
            'product_description' => $request->product_description,
            'product_quantity' => $request->product_quantity,
            'product_category' => $request->product_category,
            //'product_image' => $imageName ?? null,
            'product_price' =>$request->product_price,
        ]);

        return response()->json(['message'=>'Product created',
                                    'product'=>$product],200);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    $product = Products::find($id);
    if($product){

        $product->delete();

        return response()->json([
            "message" => "Product deleted"
        ], 200);
    }else{
        return response()->json([
            "message" => "Product do not exist.. or deleted already"
        ], 200);
    }
    
}
}
