<?php

namespace App\Http\Controllers\api;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use function Pest\Laravel\json;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //dd('dsd');
        $request->validate([
            'name'=>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'
        ]);

        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)


        ]);


        return response()->json(['message'=>'User was created', 'user'=>$user],201);
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $user= User::all();

        return response()->json($user,200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {   
        $user=User::find($id);
        if(!$user){
            return response()->json("User Not found",404);
            }
        else{
        $request->validate([
            'name' =>'required|string',
            'email'=>'required|email|unique:users,email',
            'password'=>'required'

        ]);
        $user->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)]);
                return response()->json(['message'=>'User upated',
                            'user'=>$user],200);
           }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user=User::find($id);

        if($user){
            $user->delete;
            return response()->json(['message'=>'User deleted'],200);
        }
        else{
            return response()->json(['message'=>'User do not exist or deleted already'],404);

        }
    }
}
