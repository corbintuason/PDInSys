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
    public function index(Request $request)
    {
        $users = User::query();
        if($request->get('positions')){
            $positions = $request->get('positions');
            foreach($positions as $position){
                $users->orWhereJsonContains('positions', ['name' => $position]);
            }
        }
        return UserResource::collection($users->get());
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
            'positions' => 'required',
            'module_access' => 'required',
            'contact_numbers' => 'required'
        ]);

        // Generate a random string for default password
        $password = Str::random(5);
        $request["password"] = bcrypt($password);

        $user_id = auth()->user()->id;
        $user = User::findOrFail($user_id);
        
        // Create the User
        $created_user =  activity()->withoutLogs(function() use($validatedData, $request){
           return User::create($request->except('module_access'));
        });

        // Add Permissions
        $created_user->allow($request['module_access.permissions']);

        // Add Roles
        $created_user->assign($request['module_access.roles']);
        
        // Notify Users
        FacadesMail::to($created_user->pdem_email)->send(new NewUserCreated($created_user, $password));
        
        $notify_user = User::first();
        $notify_users = collect([]);
        $notify_users->push($notify_user);
        
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
        return new UserResource(User::findorFail($id));

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
