<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\User as UserResource;
use App\Vendor;
use App\User;
use \stdclass;
use Notification;
use App\Notifications\VendorCreated;
use App\Notifications\VendorStatusChange;

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

        $user_id = auth()->user()->id;
        $auth_user = new UserResource(User::findOrFail($user_id));
        $status = "For Approval";

        $new_details = array();
        foreach ($validatedData["ewt_details"] as $detail) {
            $detail_object = new stdClass();

            $detail_object->ewt_detail = $detail["ewt_detail"];
            $detail_object->ewt_description = $detail["ewt_description"];
            $detail_object->ewt_percent = $detail["ewt_percent"];

            var_dump($detail_object);
            array_push($new_details, $detail_object);
        }

        $vendor = activity()->withoutLogs(function () use ($request, $status, $user_id, $new_details) {


            return Vendor::create([
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
                'creator_id' => $user_id,
            ]);
        });

        // Notify User that can Approve this Vendor

        $approvers = User::whereIs('vendor-approver')->get();

        Notification::send($approvers, new VendorCreated($vendor));

        // Create Activity Log
        activity('Vendor Created')
            ->on($vendor)
            ->withProperties(["link_name" => "vendor_show", "link_id" => $vendor->id])
            ->log("User " . $auth_user->last_name . ", " . $auth_user->first_name  . " has created Vendor " . $vendor->registered_name);

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

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|string|max:191',
        ]);
        $vendor = Vendor::findOrFail($id);
        $user_id = auth()->user()->id;
        $user = new UserResource(User::findOrFail($user_id));

        $old_status = $vendor->status;
        activity()->withoutLogs(function () use ($vendor, $request) {
            $vendor->update([
                'status' => $request['status'],
            ]);
        });


        // Notify the creator that the vendor has been approved
        $update_user = User::findOrFail($vendor->creator_id);
        $update_users = collect([]);
        $update_users->push($update_user);
        Notification::send($update_users, new VendorStatusChange($vendor));

        // Create Activity Log

        activity('Vendor Status Change')
            ->on($vendor)
            ->withProperties(["link_name" => "vendor_show", "link_id" => $vendor->id])
            ->log("User " . $user->last_name . ", " . $user->first_name  . " has changed Vendor " . $vendor->registered_name . "'s status from " . $old_status . " to " . $vendor->status);


        return new VendorResource($vendor);
    }
}
