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
use App\Notifications\ItemNotification;
use App\User;
use Notification;

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
        foreach ($request->brands as $brand) {
            AccountBrand::create([
                "account_id" => $account->id,
                "name" => $brand
            ]);
        }

        // Create Departments
        foreach ($request->departments as $department) {
            AccountDepartment::create([
                "account_id" => $account->id,
                "name" => $department
            ]);
        }

        // Create Clients
        foreach ($request->clients as $client) {
            $client['account_id'] = $account->id;
            Client::create($client);
        }
        // Notify Contributors
        Notification::send($this->notifyApprovers($account), new ItemNotification($account, $account::$module, "account_show", $account->id));

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
    public function update($id)
    {
        $this->validate($request, [
            'status' => 'required|string|max:191',
        ]);

        $account = Account::findOrFail($id);
        $this->updateItem($account, Account::class, "Account");

        // Notify Contributors
        Notification::send($acount->contributors, new ItemNotification($account, $account::$module, "account_show", $account->id));

        return [
            'item_id' => $account->id,
            'success_text' => "Account " . $account->code . " has been successfully updated."
        ];
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

    // NON CRUD METHODS:

    public function returnToUser(Request $request)
    {

        // Return Account  
        $remark = $this->return($request, Account::class, "Account");

        // Send Notification
        $returned_to = User::findOrFail($remark->returned_to_id);

        Notification::send($remark->returned_to, new ItemNotification($remark->remarkable, $remark->remarkable::$module, "account_show", $remark->remarkable->id));

        return [
            'item_id' => $remark->remarkable->id,
            'success_text' => "Account " . $remark->remarkable->code . " has been successfully Returned"
        ];
    }

    public function reject($id)
    {
        $account = Account::findOrFail($id);

        $rejected_account = $this->rejectItem($account, "Account");


        // Send Notification to Contribution List 
        $returned_to = User::findOrFail($remark->returned_to_id);

        Notification::send($rejected_account->contributors, new ItemNotification($rejected_account, $rejected_account::$module, "account_show"));
    }
}
