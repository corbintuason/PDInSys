<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\User as UserResource;
use App\Vendor;
use App\User;

class VendorController extends Controller
{
    //
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return VendorResource::collection(Vendor::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'vendor_name' => 'required',
        ]);

        // STATUS IS SET TO FOR APPROVAL
        $user = new UserResource(User::findOrFail($request->creator_id));
        $date_today = date('Y/m/d');
        $status = "For Approval";
        $change_log = [$date_today . ": User " . $user->last_name . " has created this vendor"];
        $vendor = Vendor::create([
            'vendor_name' => $request['vendor_name'],
            'trade_name' => $request['trade_name'],
            'registered_address' => $request['registered_address'],
            'type_business' => $request['type_business'],
            'line_business' => $request['line_business'],
            'contact_person' => $request['contact_person'],
            'contact_number' => $request['contact_number'],
            'email_address' => $request['email_address'],
            'bank_name' => $request['bank_name'],
            'status' => $status,
            'creator_id' => $request['creator_id'],
            'change_logs' => $change_log
        ]);

        return new VendorResource($vendor);
    }
}
