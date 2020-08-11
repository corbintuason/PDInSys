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
use App\Notifications\ItemNotification;
use App\Notifications\VendorCreated;
use App\Notifications\VendorStatusChange;
use App\Traits\ControllersTrait;

class VendorController extends Controller
{

    use ControllersTrait;

    public function index(Request $request)
    {
        $vendors = Vendor::query();
        $vendor_name = $request->get('vendor_name');
        $status = $request->get('status');

        if($vendor_name){
            $vendors->where('vendor_name', 'LIKE', $vendor_name);
        }

        if($status){
            $vendors->where('status', $status);
        }

        return VendorResource::collection($vendors->get());
        }

    public function store(Request $request)
    {
        // $auth_user = auth()->user();

        // $vendor = $this->createItem($request, Vendor::class, "Vendor", "vendor_show");

        // Notification::send($this->notifyApprovers($vendor), new ItemNotification($vendor, $vendor::$module, "vendor_show", $vendor->id));

        $vendor = $this->createItem($request, Vendor::class, "Vendor", true);
        
        Notification::send($this->notifyApprovers($vendor), new ItemNotification($vendor, $vendor::$module, "vendor_show", $vendor->id));

        return [
            'item_id' => $vendor->id,
            'success_text' => "Vendor " . $vendor->code . " has been successfully created"
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
        return new VendorResource(Vendor::findorFail($id));
    }

    public function update(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $this->updateItem($vendor, Vendor::class, "Vendor");

        if ($request->get("skipped")) {
            $this->skipRemark($vendor, Vendor::class);
        }

        Notification::send($this->notifyApprovers($vendor), new ItemNotification($vendor, $vendor::$module, "vendor_show", $vendor->id));


        return [
            'item_id' => $vendor->id,
            'success_text' => "Vendor " . $vendor->code . " has been successfully updated"
        ];
    }

    // NON CRUD METHODS:

    public function saveChanges(Request $request, $id)
    {
        $vendor = Vendor::findOrFail($id);
        $updated_vendor = $this->saveChangesToItem($request, Vendor::class, $vendor, "Vendor");

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
