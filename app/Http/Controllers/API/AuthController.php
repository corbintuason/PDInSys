<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use Auth;
class AuthController extends Controller
{
    public function user(){
        $current_user = Auth::user();
        dd($current_user);
        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        dd($accessToken);
        $response = $client->request('GET', '/api/user', [
            'headers' => [
                'Accept' => 'application/json',
                'Authorization' => 'Bearer '.$accessToken,
            ],
        ]);

    }
    public function register(Request $request){
        $validatedData = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'official_photo' => 'required',
            'group' => 'required',
            'job_level' => 'required',
            'pdem_email' => 'required',
            'pdem_gmail' => 'required',
            'contact_numbers' => 'required',
            'employment_date' => 'required',
        ]);
        
        // default pass muna
        $validatedData["password"] = bcrypt("password");
        // dd($validatedData);

        $user = User::create($validatedData);
        return response($user);
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'pdem_email' => 'email|required',
            'password' => 'required'
        ]);

        if(!auth()->attempt($loginData)){
            return response(['message' => 'Invalid Credentials', 'value' => false]);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        
        return response(['user' => auth()->user(), 'access_token' => $accessToken]);
        // return response(['message' => 'Login Success', 'value' => true]);
    }

    public function logout(Request $request){
        auth()->user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response()->json("Logged Out Successfully", 200); 
    }
}
