<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Account as AccountResource;
use App\Http\Resources\User as UserResource;
use App\Account;
use App\User;

class AccountController extends Controller
{
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
  

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
        'registered_name' => 'required',
        'registered_address' => 'required',
        ]);
        
        // STATUS IS SET TO FOR APPROVAL
        $user = new UserResource(User::findOrFail($request->creator_id));
        $date_today = date('Y/m/d');
        $status = "For Approval";
        $change_log = [$date_today.": User " . $user->last_name . " has created this account"];
        $account = Account::create([
        'registered_name' => $request['registered_name'],
        'registered_address' => $request['registered_address'],
        'registered_tin'=> $request['registered_tin'],
        'status' => $status,
        'terms_of_payment'=> $request['terms_of_payment'],
        'payment_milestone'=> $request['payment_milestone'],
        'company_tel_number'=> $request['company_tel_number'],
        'company_email_address'=> $request['company_email_address'],
        'accreditation_status'=> $request['accreditation_status'],
        "brands"=> $request["brands"],
        "departments"=> $request["departments"],
        'clients'=> $request['clients'],
        'creator_id' => $request['creator_id'],
        'change_logs' => $change_log
        ]);

        return new AccountResource($account);
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
      
        //  return response()->json($blood_request);
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
        $account = Account::findOrFail($id);
        $this->validate($request,[
            'status' => 'required|string|max:191',
         ]);
        //  $change_logs = $account->change_logs;
        //  dd($request);
        //  $user = new UserResource(User::findOrFail($request->updator_id));
        //  $date_today = date('Y/m/d');
        //  $status = "For Approval";
        //  $change_log = $date_today.": User " . $user->last_name . " has updated the status of this account to " . $request->status;

        //  array_push($change_logs, $change_log);
         $account->update([
             'status' => $request['status'],
         ]);
        
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
