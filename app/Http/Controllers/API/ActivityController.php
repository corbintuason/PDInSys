<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index(){

        $activities = auth()->user()->actions;

        return $activities;
    }
}
