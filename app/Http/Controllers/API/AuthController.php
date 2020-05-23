<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\User as UserResource;
use App\User;
use Auth;
class AuthController extends Controller
{
    public function user(Request $request){
            return new UserResource(auth()->user());
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'pdem_email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message' => 'Invalid Credentials', 'value' => false], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        // return response(['message' => 'Login Success', 'value' => true]);
    }

    public function logout(Request $request){
        $request->user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response()->json("Logged Out Successfully", 200); 
    }
}
