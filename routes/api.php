<?php

use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\AuthenticatedSessionController;
use App\Http\Controllers\api\RegisteredUserController;
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
Route::post('create_product',[ProductController::class,'store']);
Route::get('read_product',[ProductController::class,'index']);

//AUTH
Route::post('login_api', [AuthenticatedSessionController::class, 'store']);
Route::post('register_api', [RegisteredUserController::class, 'store']);



//User clicks button → Frontend → API → Database → API → Frontend → UI updates

