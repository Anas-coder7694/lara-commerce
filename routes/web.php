<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::get('/', [UserController::class,'home'])->name('index');
Route::get('/product_details/{id}',[UserController::class,'productDetails'])->name('product_details');
Route::get('/add_to_cart/{id}',[UserController::class,'AddToCart'])->name('add_to_cart');
       // cartproducts



Route::get('/test_admin',function(){
    return view('admin.test_admin');
});



Route::get('/dashboard',[UserController::class,'index'])->middleware(['auth', 'verified'])->name('dashboard');
Route::get('/cartproducts',[UserController::class,'cartProduct'])->middleware(['auth', 'verified'])->name('cartproducts');
Route::get('/removecartproducts/{id}',[UserController::class,'removeCartProducts'])->middleware(['auth', 'verified'])->name('removecartproducts');
Route::post('/confirm_order',[UserController::class,'confirmOrder'])->middleware(['auth', 'verified'])->name('confirm_order');

Route::get('/myorders',[UserController::class,'myOrders'])->middleware(['auth', 'verified'])->name('myorders');

Route::controller(UserController::class)->middleware(['auth', 'verified'])->group(function(){

    Route::get('stripe/{price}', 'stripe')->name('stripe');

    Route::post('stripe', 'stripePost')->name('stripe.post');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('admin')->group(function () {
    Route::get('/add_category', [AdminController::class, 'addCategory'])->name('admin.addcategory');
    Route::post('/add_category', [AdminController::class, 'postAddCategory'])->name('admin.postaddcategory');
    Route::get('/view_category', [AdminController::class, 'viewCategory'])->name('admin.viewcategory');
    Route::get('/update_category/{id}', [AdminController::class, 'updateCategory'])->name('admin.updatecategory');
    Route::get('/delete_category/{id}', [AdminController::class, 'deleteCategory'])->name('admin.deletecategory');
    Route::post('/update_category/{id}', [AdminController::class, 'postUpdateCategory'])->name('admin.postupdatecategory');
    
    //Products
    Route::get('/add_product',[AdminController::class,'addProduct'])->name('admin.addproduct');
    Route::post('/add_product', [AdminController::class, 'postAddProduct'])->name('admin.postaddproduct');
    Route::get('/view_product',[AdminController::class,'viewProducts'])->name('admin.viewproducts');
    Route::get('/delete_product/{id}', [AdminController::class, 'deleteProduct'])->name('admin.deleteproduct');
    Route::get('/update_product/{id}',[AdminController::class,'updateProduct'])->name('admin.updateproduct');
    Route::post('/update_product/{id}',[AdminController::class,'postUpdateProduct'])->name('admin.postupdateproduct');
    Route::any('/search',[AdminController::class,'searchProduct'])->name('admin.searchproduct');
    
    Route::get('vieworder',[AdminController::class,'viewOrder'])->name('admin.vieworder');
    Route::post('/change_status/{id}',[AdminController::class,'changeStatus'])->name('admin.change_status');
    Route::get('/downloadpdf/{id}',[AdminController::class,'downloadPDF'])->name('admin.downloadpdf');
    
    //Users
    Route::get('/view_users',[AdminController::class,'viewUsers'])->name('admin.userlist');
    Route::get('/view_user_orders/{id}',[AdminController::class,'viewUserOrders'])->name('admin.user.orders');
    
    // admin.user.orders
    
    });

require __DIR__.'/auth.php';
