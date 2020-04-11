<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\User as UserResource;
use App\Vendor;
use App\User;
use \stdclass;

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

        // STATUS IS SET TO FOR APPROVAL
        $user = new UserResource(User::findOrFail($request->creator_id));
        $date_today = date('Y/m/d');
        $status = "For Approval";
        $change_log = [$date_today . ": User " . $user->last_name . " has created this vendor"];

        $validatedData = $request->validate([
            'vendor_name' => 'required',
            'trade_name' => 'required',
            'registered_address' => 'required',
            'type_business' => 'required',
            'line_business' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',
            'email_address' => 'required',
            'bank_details' => 'required',
            'tin_number' => 'required',
            'type_vat' => 'required',
            'ewt_details' => 'required',
        ]);

        $validatedData["status"] = $status;
        $validatedData["creator_id"] = $request['creator_id'];
        $validatedData["change_logs"] = $change_log;

        $new_details = array();
        foreach ($validatedData["ewt_details"] as $detail) {
            $detail_object = new stdClass();

            $detail_object->ewt_detail = $detail["ewt_detail"];
            $detail_object->ewt_description = $detail["ewt_description"];
            $detail_object->ewt_percent = $detail["ewt_percent"];

            var_dump($detail_object);
            array_push($new_details, $detail_object);
        }

        $vendor = Vendor::create([
            'vendor_name' => $request['vendor_name'],
            'trade_name' => $request['trade_name'],
            'registered_address' => $request['registered_address'],
            'type_business' => $request['type_business'],
            'line_business' => $request['line_business'],
            'contact_person' => $request['contact_person'],
            'contact_number' => $request['contact_number'],
            'email_address' => $request['email_address'],
            'bank_details' => $request['bank_details'],
            'tin_number' => $request['tin_number'],
            'type_vat' => $request['type_vat'],
            'ewt_details' => $new_details,
            'status' => $status,
            'creator_id' => $request['creator_id'],
            'change_logs' => $change_log
        ]);

        return new VendorResource($vendor);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new VendorResource(Vendor::findorFail($id));
    }
}
