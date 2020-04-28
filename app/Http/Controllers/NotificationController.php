<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class NotificationController extends Controller
{
    public function markAsRead(Request $request, User $user){
        $user = auth()->user();
        $user->unreadNotifications->markAsRead();
        return response(['notifications' => $user->notifications]);
    }
}
