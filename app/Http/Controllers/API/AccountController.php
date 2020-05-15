<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;
use App\Account;
use App\AccountBrand;
use App\AccountDepartment;
use App\Client;
use App\Http\Resources\Account as AccountResource;
class AccountController extends Controller
{
    use ControllersTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AccountResource::collection(Account::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate
        $validatedData = $request->validate([
            'registered_name' => 'required',
            'registered_address' => 'required',
        ]);
        
        // Create Account 
        $account = $this->createItem($request, Account::class, "Account", "account_show");
        
        // Create Brands
        foreach($request->brands as $brand){
            AccountBrand::create([
                "account_id" => $account->id,
                "name" => $brand
            ]);
        }

        // Create Departments
        foreach($request->departments as $department){
            AccountDepartment::create([
                "account_id" => $account->id,
                "name" => $department
            ]);        
        }

        // Create Clients
        foreach($request->clients as $client){
            $client['account_id'] = $account->id;
            Client::create($client);
        }

        return [
            'item_id' => $account->id,
            'success_text' => " " . $account->code . " has been successfully created."
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new AccountResource(Account::findorFail($id));
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
        $this->validate($request, [
            'status' => 'required|string|max:191',
        ]);
        $account = Account::findOrFail($id);
        $user_id = auth()->user()->id;
        $user = new UserResource(User::findOrFail($user_id));

        $old_status = $account->status;
        activity()->withoutLogs(function() use($account, $request){
            $account->update([
                'status' => $request['status'],
            ]);
        });
        
        
        // Notify the creator that the account has been approved
        $update_user = User::findOrFail($account->creator_id);
        $update_users = collect([]);
        $update_users->push($update_user);
        Notification::send($update_users, new AccountStatusChange($account));

         // Create Activity Log
        
         activity('Account Status Change')
         ->on($account)
         ->withProperties(["link_name" => "account_show", "link_id" => $account->id])
         ->log("User " . $user->last_name .", " . $user->first_name  . " has changed Account " . $account->registered_name . "'s status from ". $old_status . " to ". $account->status);
 

        return new AccountResource($account);
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
