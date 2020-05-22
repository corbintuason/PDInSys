<?php

namespace App\Http\Controllers\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Mail\NewUserCreated;
use App\User;
use Mail;

class UserController extends Controller
{
    // Function to notify user default password
    public function newUserCreated(User $user)
    {
        $password = "test";
        $user = User::first();
        Mail::to($user->pd_email)->send(new NewUserCreated($user, $password));
    }
}
