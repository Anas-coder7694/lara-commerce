<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PasswordChangeController extends Controller
{
    public function ChangePassword(Request $request){
        
        $request->validate([
            'current_password'=>'required',
            'new_password'=>'required|min:8'
        ]);   

        //Already logged in user no email needed
        //From bearer token

        $user = $request->user();
        $email=$user->email;
       // echo $user; die;
        $userDB=User::Where('email',$email);
        if(!Hash::check($request->current_password,$userDB->password)){
            return response()->json(["message"=>"Incorrect password"],400);
        }


        if(Hash::check($request->new_password,$userDB->request)){
            return response()->json(["message"=>"New Password must be different from Current Password"],400);
        }

        $userDB->update([
            'password'=>Hash::make($request->new_password),
        ]);

         return response()->json(["message"=>"Password changed successfully"],400);




    }    

}
