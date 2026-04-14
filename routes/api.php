<?php

use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthenticatedSessionController;
use App\Http\Controllers\api\RegisteredUserController;
use App\Http\Controllers\api\ForgetPasswordController;
use App\Http\Controllers\api\PasswordChangeController;
use App\Http\Controllers\api\AddProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\Hash;




//USER
Route::post('create_user',[UserController::class,'store']);
Route::get('read_user',[UserController::class,'show']);
Route::patch('update_user/{id}',[UserController::class,'update']);
Route::delete('delete_user/{id}',[UserController::class,'destroy']);

//PRODUCT
// Route::post('create_product',[ProductController::class,'store']);

// Route::middleware('auth:sanctum')->post('/create_product', [ProductController::class,'store']);
Route::group(['prefix'=>'/admin','middleware'=>'auth:sanctum'],function(){
        Route::get('read_product',[ProductController::class,'index']);
        Route::post('create_product',[ProductController::class,'store']);
        Route::delete('delete_product/{id}',[ProductController::class,'destroy']);
        Route::post('/change-password', [PasswordChangeController::class, 'ChangePassword']);





        });
        

//AUTH
Route::post('login_api', [AuthenticatedSessionController::class, 'store']);
Route::post('register_api', [RegisteredUserController::class, 'store']);
Route::post('/forgot-password', [ForgetPasswordController::class, 'sendResetLink']);
Route::post('/change-password', [PasswordChangeController::class, 'ChangePassword']);


//ADD_PRODUCT


//Route::post('add_product',[AddProductController::class,'AddProduct']);




//User clicks button → Frontend → API → Database → API → Frontend → UI updates

