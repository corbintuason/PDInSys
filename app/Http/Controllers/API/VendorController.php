<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Vendor as VendorResource;
use App\Http\Resources\User as UserResource;
use App\Vendor;
use App\VendorContributor;
use App\User;
use \stdclass;
use Notification;
use App\Notifications\VendorCreated;
use App\Notifications\VendorStatusChange;
use App\Traits\ControllersTrait;

class VendorController extends Controller
{

    use ControllersTrait;

    public function index()
    {
        return VendorResource::collection(Vendor::all());
    }

    public function store(Request $request)
    {
        // $auth_user = auth()->user();

        $vendor = $this->createItem($request, Vendor::class, "Vendor", "vendor_show");

        Notification::send($this->notifyApprovers($vendor), new ItemNotification($vendor, $vendor::$module, "vendor_show", $vendor->id));

        return [
            'item_id' => $vendor->id,
            'success_text' => "Vendor " . $vendor->code . " has been successfully created"
        ];


        // $user_id = auth()->user()->id;
        // $auth_user = new UserResource(User::findOrFail($user_id));
        // $status = "For Approval";

        // $new_details = array();
        // foreach ($validatedData["ewt_details"] as $detail) {
        //     $detail_object = new stdClass();

        //     $detail_object->ewt_detail = $detail["ewt_detail"];
        //     $detail_object->ewt_description = $detail["ewt_description"];
        //     $detail_object->ewt_percent = $detail["ewt_percent"];

        //     var_dump($detail_object);
        //     array_push($new_details, $detail_object);
        // }

        // $vendor = activity()->withoutLogs(function () use ($request, $status, $user_id, $new_details) {


        //     return Vendor::create([
        //         'vendor_name' => $request['vendor_name'],
        //         'trade_name' => $request['trade_name'],
        //         'registered_address' => $request['registered_address'],
        //         'type_business' => $request['type_business'],
        //         'line_business' => $request['line_business'],
        //         'contact_person' => $request['contact_person'],
        //         'contact_number' => $request['contact_number'],
        //         'email_address' => $request['email_address'],
        //         'bank_details' => $request['bank_details'],
        //         'tin_number' => $request['tin_number'],
        //         'type_vat' => $request['type_vat'],
        //         'ewt_details' => $new_details,
        //         'status' => $status,
        //         'creator_id' => $user_id,
        //     ]);
        // });

        // $vendor_contributor = VendorContributor::create([
        //     'vendor_id' => $vendor->id,
        //     'contributor_id' => $auth_user->id,
        //     'responsibility' => "Creator"
        // ]);

        // // Notify User that can Approve this Vendor

        // $approvers = User::whereIs('vendor-approver')->get();

        // Notification::send($approvers, new VendorCreated($vendor));

        // // Create Activity Log
        // activity('Vendor Created')
        //     ->on($vendor)
        //     ->withProperties(["link_name" => "vendor_show", "link_id" => $vendor->id])
        //     ->log("User " . $auth_user->last_name . ", " . $auth_user->first_name  . " has created Vendor " . $vendor->registered_name . ' ' . $vendor->code);

        // return new VendorResource($vendor);
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
        $vendor = Vendor::findOrFail($id);
        $this->updateItem($vendor, Vendor::class, "Vendor");

        if ($skipped) {
            $this->skipRemark($vendor, Vendor::class);
        }

        Notification::send($vendor->contributors, new ItemNotification($vendor, $vendor::$module, "vendor_show", $vendor->id));

        return [
            'item_id' => $vendor->id,
            'success_text' => "Vendor " . $vendor->code . " has been successfully updated"
        ];
    }

    // NON CRUD METHODS:

    public function saveChanges(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $updated_vendor = $this->saveChangesToItem($request, Vendor::class, $vendor, "vendor");

        Notification::send($this->notifyApprovers($updated_vendor), new ItemNotification($updated_vendor, $updated_vendor::$module, "vendor_show", $updated_vendor->id));

        return [
            'refresh' => true,
            'success_text' => $vendor->code . " has been successfully edited.",
        ];
    }

    public function returnToUser(Request $request)
    {

        // Return Vendor  
        $remark = $this->return($request, Vendor::class, "Vendor");

        // Send Notification
        $returned_to = User::findOrFail($remark->returned_to_id);

        Notification::send($remark->returned_to, new ItemNotification($remark->remarkable, $remark->remarkable::$module, "vendor_show", $remark->remarkable->id));

        return [
            'item_id' => $remark->remarkable->id,
            'success_text' => "Vendor " . $remark->remarkable->code . " has been successfully Returned"
        ];
    }

    public function reject(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);

        $this->rejectItem($request, Vendor::class, $vendor, "Vendor");

        Notification::send($this->getContributors($vendor), new ItemNotification($vendor, $vendor::$module, "vendor_show", $vendor->id));

        return [
            'success_text' => $vendor->code . " has been successfully Rejected",
        ];
    }
}
