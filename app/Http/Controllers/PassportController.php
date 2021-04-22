<?php

namespace App\Http\Controllers;

use App\user;
use Illuminate\Http\Request;

class PassportController extends Controller
{
    public function register(Request $request){
        $this->validate($request, [
            'name' => "required|min:3",
            'nid' => "required|min:10|max:12",
            'age' => "required|min:2",
            'sex' => "required",
            'address' => "required|min:3",
            'profession' => "required|min:3",
            'mobile_no' => "required|min:10",
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'nid' => $request->nid,
            'age' => $request->age,
            'sex' => $request->sex,
            'address' => $request->address,
            'profession' => $request->profession,
            'mobile_no' => $request->mobile_no,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $token = $user->createToken('authToken')->accessToken;

        return response()->json(['token' => $token],200);
    }

    public function login(Request $request){
        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if(auth()->attempt($credentials)){
            $token = auth()->user()->createToken('authToken')->accessToken;
            return response()->json(['token'=>$token],200);
        }else{
            return response()->json(['error'=> 'Unauthorized'],401);
        }
    }
    public function details(){
        return response()->json(['user'=>auth()->user()],200);
    }

}
