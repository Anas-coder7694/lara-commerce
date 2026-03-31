<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
//use App\Models\OrderItem;
use Illuminate\Http\Request;
//use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;

class Vendors extends Controller
{
    //
    public function vendorOrders(){
        // Fetch only the order items that belong to the logged-in vendor's products
        $order_items = OrderItem::whereHas('product', function($query) {
            $query->where('vendor_id', Auth::id());
        })->with('order')->get();

        return view('vendor.orders', compact('order_items'));
    }
       public function ViewCategory(){
        $categories=Category::all();
        return view('admin.viewcategory',compact('categories'));
    }

    

    

    

    public function addProduct(){
       $categories =Category::all();
        return view('admin.addproduct',compact('categories'));
    }
 public function postAddProduct(Request $request){

    $product = new Products();
    $product->product_title = $request->product_title;
    $product->product_description = $request->product_description;
    $product->product_quantity = $request->product_quantity;
    $product->product_price = $request->product_price;
    $product->product_category = $request->product_category;
    $product->vendor_id = Auth::id();
    if($request->hasFile('product_image')){
        $image = $request->file('product_image');
        $imagename = time().'.'.$image->getClientOriginalExtension();
        
        // Move image to folder
        $image->move(public_path('products'), $imagename);

        // Save image name in DB
        $product->product_image = $imagename;
    }

    $product->save();

    return redirect()->back()->with('product_message','Product added successfully!');
}

    public function viewProducts(){
        $products =Products::paginate(2);
        return view('admin.viewproduct',compact('products'));

    }

    public function deleteProduct($id){
        $product=Products::findOrfail($id);
        $product->delete();
        return redirect()->back()->with('deleteproduct_message','product deleted successfully!');
    }

    public function updateProduct($id){
        $product=Products::findOrFail($id);
        $categories =Category::all();
        return view('admin.updateproduct',compact('product','categories'));
    }

    public function postUpdateProduct (Request $request,$id){
        $product=Products::findOrFail($id);
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        if($request->hasFile('product_image')){
            $image = $request->file('product_image');
            $imagename = time().'.'.$image->getClientOriginalExtension();
            
            // Move image to folder
            $image->move(public_path('products'), $imagename);

            // Save image name in DB
            $product->product_image = $imagename;
        }

        $product->vendor_id = Auth::user()->vendor->id;
        $product->save();

        return redirect()->back()->with('product_message','Product added successfully!');
    }

}
