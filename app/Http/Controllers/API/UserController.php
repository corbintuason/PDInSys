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
use Notification;

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
            'module_access' => 'required',
            'contact_numbers' => 'required'
        ]);

        // Generate a random string for default password
        $password = Str::random(5);
        $validatedData["pdem_email"] = $validatedData["pdem_email"];
        $validatedData["password"] = bcrypt($password);

        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);

        $created_user =  activity()->withoutLogs(function() use($validatedData){
           return User::create($validatedData);
        });

        // if($request->official_photo!=null){
        //     $official_photo = $request->file('official_photo');
        //     $fileName = time().'.'.$official_photo->getClientOriginalExtension();
        //     Image::make($official_photo)->resize(300, 300)->save( public_path('/storage/officialPhotos/'.$fileName));
        //     $user = Auth::user();
        //     $user->official_photo = $fileName;
        //     $user->save();
        // }
        
        // Notify Users
        FacadesMail::to($created_user->pdem_email)->send(new NewUserCreated($created_user, $password));
        
        $notify_user = User::first();
        $notify_users = collect([]);
        $notify_users->push($notify_user);
        // $notify_user->notify(new UserRegistered($created_user));
        
        Notification::send($notify_users, new UserRegistered($created_user));

        activity('User Created')
        ->on($created_user)
        ->withProperties(["link_name" => "user_show", "link_id" => $created_user->id])
        ->log("User " . $user->last_name .", " . $user->first_name  . " has created User " . $created_user->last_name .", " . $created_user->first_name .".");

        return response($created_user);
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
        $user = User::findOrFail($id);
        $user->update([
            'password' => bcrypt($request['password']),
        ]);
        return new UserResource($user);

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
