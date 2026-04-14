<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\Products;

class VendorController extends Controller
{
    // ✅ Get logged-in vendor safely
    private function getVendor()
    {  // dd(Auth::user()->id);
        $vendor = Auth::user()->vendor;

        if (!$vendor) {
            abort(403, 'Unauthorized');
        }

        return $vendor;
    }

    public function index(){
        
    }
    // ✅ Vendor Orders
    public function vendorOrders()
    {
        $vendor = $this->getVendor();

        $order_items = OrderItem::whereHas('product', function ($query) use ($vendor) {
            $query->where('vendor_id', $vendor->id);
        })->with('order')->get();

        return view('vendor.orders', compact('order_items'));
    }

    // ✅ View Categories (no change)
    public function ViewCategory()
    {
        $categories = Category::all();
        return view('vendor.viewcategory', compact('categories'));
    }

    // ✅ Add Product Page
    public function addProduct()
    {


   
        $categories = Category::all();
        return view('vendor.addproduct', compact('categories'));
    }

    // ✅ Store Product
    public function postAddProduct(Request $request)
    {
       $vendor = $this->getVendor();
        dd($vendor->id);
        $product = new Products();
        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        // ✅ Correct vendor ID
       $product->vendor_id = $vendor->id;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imagename);
            $product->product_image = $imagename;
        }

        $product->save();

        return redirect()->back()->with('product_message', 'Product added successfully!');
    }

    // ✅ View ONLY vendor products
    public function viewProducts()
    {
        $vendor = $this->getVendor();

        $products = Products::where('vendor_id', $vendor->id)->paginate(2);

        return view('vendor.viewproduct', compact('products'));
    }

    // ✅ Delete only own product
    public function deleteProduct($id){
       $vendor = $this->getVendor();

        $product = Products::where('id', $id)
                           ->where('vendor_id', $vendor->id)
                           ->firstOrFail();

        $product->delete();

        return redirect()->back()->with('deleteproduct_message', 'Product deleted successfully!');
    }

    // ✅ Update form
    public function updateProduct($id)
    {
        $vendor = $this->getVendor();

        $product = Products::where('id', $id)
                           ->where('vendor_id', $vendor->id)
                           ->firstOrFail();

        $categories = Category::all();

        return view('admin.updateproduct', compact('product', 'categories'));
    }

    // ✅ Update product
    public function postUpdateProduct(Request $request, $id)
    {
        $vendor = $this->getVendor();

        $product = Products::where('id', $id)
                           ->where('vendor_id', $vendor->id)
                           ->firstOrFail();

        $product->product_title = $request->product_title;
        $product->product_description = $request->product_description;
        $product->product_quantity = $request->product_quantity;
        $product->product_price = $request->product_price;
        $product->product_category = $request->product_category;

        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imagename = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('products'), $imagename);
            $product->product_image = $imagename;
        }

        // ✅ Always enforce correct vendor
        $product->vendor_id = $vendor->id;

        $product->save();

        return redirect()->back()->with('product_message', 'Product updated successfully!');
    }
}