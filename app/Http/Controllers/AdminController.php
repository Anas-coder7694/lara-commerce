<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\User;
use App\Models\Orders;
use App\Models\Products;

use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function AddCategory()
    {
        return view('admin.addcategory');
    }

    public function postAddCategory(Request $request){
        $category= new Category();
        $category->category=$request->category;
        $category->save();
        return redirect()->back()->with('category_message','Category added successfully!!');
       
    }
    public function ViewCategory(){
        $categories=Category::all();
        return view('admin.viewcategory',compact('categories'));
    }

    public function deleteCategory($id){
        $category=Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('deletecategory_message','Delete successfully');
    }

    public function updateCategory($id){
       $category =Category::findOrFail($id);
       return view('admin.updatecategory',compact('category'));
    }

    public function postUpdateCategory(Request $request,$id){
        $category=Category::findOrFail($id);

        $category->category=$request->category;
         return redirect()->back()->with('category_updated_message','Category Updated successfully!!');
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

        $product->save();

        return redirect()->back()->with('product_message','Product added successfully!');
    }

    public function searchProduct(Request $request){
        $products= Products::where('product_title','LIKE','%'.$request->search.'%')
                            ->orWhere('product_description','LIKE','%'.$request->search.'%')
                            ->orWhere('product_category','LIKE','%'.$request->search.'%')
                            ->paginate(2);

        return view ('admin.viewproduct',compact('products'));
    }

//viewUsers
    public function viewUsers(){
        $user=User::all();
        return view ('admin.user_list',compact('user'));
    }
    public function viewOrder(){
       $orders = Orders::where('user_id', Auth::id())->get();
       return view('admin.vieworders',compact('orders'));
    }

}
