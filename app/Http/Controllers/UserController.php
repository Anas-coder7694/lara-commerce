<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\ProductCart;
use App\Models\Products;
use App\Models\Orders;
use App\Models\OrderItem;
use App\Mail\OrderConfirmedMail;
use Illuminate\Support\Facades\Mail;
use App\Events\OrderPlaced;

//use App\Models\Orders;
//use App\Models\ProductCart;
//use Illuminate\Support\Facades\Auth;



class UserController extends Controller
{
   public function index(){
        
            if(Auth::check() && Auth::user()->user_type=="user"){
                return view('dashboard');
            }else if(Auth::check() && Auth::user()->user_type=="admin"){
                return view('admin.dashboard');
            }
        
   }

   public function home(){
          if(Auth::check()){
               $count =ProductCart::where('user_id',Auth::id())->sum('quantity');
          }
          else{
               $count ='';
          }
        $products =Products::all();
        return view('index',compact('products','count'));
   }
   public function productDetails($id)
{
    $product = Products::findOrFail($id);

    if(Auth::check()){
               $count =ProductCart::where('user_id',Auth::id())->sum('quantity');
     }
     else{
               $count ='';
     }

    $available_stock = session("product_stock_{$product->id}", $product->product_quantity);

    return view('product_details', compact('product','available_stock','count'));
}

public function AddToCart($id)
{
    $product = Products::findOrFail($id);

    // Get current available stock from session or DB
    $available_stock = session("product_stock_{$product->id}", $product->product_quantity);

    if($available_stock <= 0){
        return redirect()->back()->with('cart_message', 'Product out of stock');
    }

    // Add to cart
    $existing = ProductCart::where('user_id', Auth::id())
                ->where('product_id', $product->id)
                ->first();

    if($existing){
        if($existing->quantity >= $available_stock){
            return redirect()->back()->with('cart_message', 'Cannot add more, stock limit reached');
        }
        $existing->quantity += 1;
        $existing->save();
    }
    else{
        $product_cart = new ProductCart();
        $product_cart->user_id = Auth::id();
        $product_cart->product_id = $product->id;
        $product_cart->quantity = 1;
        $product_cart->save();
    }

    // Reduce available stock in session
    session(["product_stock_{$product->id}" => $available_stock - 1]);

    return redirect()->back()->with('cart_message', 'Added to the cart');
}

     public function cartProduct()
{
    if(!Auth::check()){
        return redirect()->route('login');
    }
     if(Auth::check()){
               $count =ProductCart::where('user_id',Auth::id())->sum('quantity');
     }
     else{
               $count ='';
     }
    $cart = ProductCart::where('user_id', Auth::id())->get();

    return view('viewcartproducts', compact('cart','count'));
}

public function confirmOrder1(Request $request)
{
    $cart = ProductCart::where('user_id', Auth::id())->get();
       
    if ($cart->isEmpty()) {
        return redirect()->back()->with('deleteproduct_message', 'Your cart is empty!');
    }

    // Calculate total
    $total = 0;
    foreach ($cart as $cart_item) {
        $total += $cart_item->product->product_price * $cart_item->quantity;
    }

    // Create Order
    $order = new Orders();
    $order->user_id = Auth::id();
    $order->total_price = $total;
    $order->status = 'pending';
    $order->receiver_address = $request->receiver_address;
    $order->receiver_phone = $request->receiver_phone;
    $order->save();

    // Create Order Items & Reduce Product Stock
    foreach ($cart as $cart_item) {

        // Reduce stock
        $product = $cart_item->product;
        if ($product) {
            $product->product_quantity -= $cart_item->quantity;

            // Optional: Prevent negative stock
            if ($product->product_quantity < 0) {
                $product->product_quantity = 0;
            }

            $product->save();
        }

        // Save order item
        OrderItem::create([
            'order_id' => $order->id,
            'product_id' => $cart_item->product_id,
            'quantity' => $cart_item->quantity,
            'product_price' => $cart_item->product->product_price ?? 0, 
            'total_price' => ($cart_item->product->product_price ?? 0) * $cart_item->quantity,
        ]);
    }

    // Send email (you can later replace this with queued job)
    $items = OrderItem::where('order_id', $order->id)->get();
    Mail::to(Auth::user()->email)->send(new OrderConfirmedMail($order, $items));

    // Clear user cart
    ProductCart::where('user_id', Auth::id())->delete();

    return redirect()->route('cartproducts')->with('confirm_order', 'Your order has been placed successfully!');
}

public function confirmOrder(Request $request)
{
    $cart = ProductCart::where('user_id', Auth::id())->with('product')->get();
    
    if ($cart->isEmpty()) {
        return redirect()->back()->with('deleteproduct_message', 'Your cart is empty!');
    }

    $total = $cart->sum(fn($item) => $item->product->product_price * $item->quantity);

    // 1. Create the Order base record
    $order = Orders::create([
        'user_id'          => Auth::id(),
        'total_price'      => $total,
        'status'           => 'pending',
        'receiver_address' => $request->receiver_address,
        'receiver_phone'   => $request->receiver_phone,
    ]);

    // 2. 🔥 Dispatch the Event
    event(new OrderPlaced($order, $cart));

    // 3. Clear user cart
    ProductCart::where('user_id', Auth::id())->delete();

    return redirect()->route('cartproducts')->with('confirm_order', 'Your order has been placed successfully!');
}

}
