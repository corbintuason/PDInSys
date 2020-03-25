<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Account as AccountResource;
use App\Account;

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
        $account = Account::create([
        'registered_name' => $request['registered_name'],
        'registered_address' => $request['registered_address'],
        'registered_tin'=> $request['registered_tin'],
        'terms_of_payment'=> $request['terms_of_payment'],
        'payment_milestone'=> $request['payment_milestone'],
        'company_tel_number'=> $request['company_tel_number'],
        'company_email_address'=> $request['company_email_address'],
        'accreditation_status'=> $request['accreditation_status'],
        "brands"=> $request["brands"],
        "departments"=> $request["departments"],
        'clients'=> $request['clients'],
        ]);
        return response($account);
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
