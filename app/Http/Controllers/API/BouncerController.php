<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Bouncer;
use App\ERFP;
class BouncerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function hasAbility(Request $request)
    {

        if($request->model_id!=null){
            $model = $request->model::findOrFail($request->model_id);
        }else{
            $model = $request->model;
        }
        $user = auth()->user();
        $can = $user->can($request->ability, $model);

        return [
            "model" => $model,
            "value" => $can
        ];
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
}
