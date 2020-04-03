<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\User;
use App\Http\Resources\User as UserResource;
use Mail;
use App\Mail\NewUserCreated;
use Illuminate\Support\Facades\Mail as FacadesMail;
use Image;
use App\Notifications\UserRegistered;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return UserResource::collection(User::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'middle_name' => 'required',
            'employment_date' => 'required',
            'birth_date' => 'required',
            'pdem_email' => 'required',
            'pdem_gmail' => 'required',
            'job_details' => 'required',
            'module_access' => 'required'

        ]);

        // Generate a random string for default password
        $password = Str::random(5);
        $validatedData["pdem_email"] = $validatedData["pdem_email"];
        $validatedData["password"] = bcrypt($password);

        $user = User::create($validatedData);
        // if($request->official_photo!=null){
        //     $official_photo = $request->file('official_photo');
        //     $fileName = time().'.'.$official_photo->getClientOriginalExtension();
        //     Image::make($official_photo)->resize(300, 300)->save( public_path('/storage/officialPhotos/'.$fileName));
        //     $user = Auth::user();
        //     $user->official_photo = $fileName;
        //     $user->save();
        // }

        FacadesMail::to($user->pdem_email)->send(new NewUserCreated($user, $password));
        $notify_user = User::first();
        $notify_user->notify(new UserRegistered($user));
        return response($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
