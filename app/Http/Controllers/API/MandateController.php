<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Mandate as MandateResource;
use App\Mandate;
use App\User;
use Notification;
use App\Notifications\ItemNotification;
use App\Notifications\MandateCreated;
use App\Notifications\MandateStatusChange;
use App\Traits\ControllersTrait;

class MandateController extends Controller
{
    use ControllersTrait;

    public function index()
    {
        return MandateResource::collection(Mandate::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

        // $auth_user = auth()->user();

        $mandate = $this->createItem($request, Mandate::class, "Mandate", "mandate_show");

        // Notification::send($this->notifyApprovers($mandate), new MandateCreated($mandate));
        Notification::send($this->notifyApprovers($mandate), new ItemNotification($mandate, $mandate::$module, "mandate_show", $mandate->id));

        return [
            'item_id' => $mandate->id,
            'success_text' => "Mandate " . $mandate->code . " has been successfully created"
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mandate  $mandate
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new MandateResource(Mandate::findorFail($id));
    }


    public function update(Request $request, $id)
    {
        $mandate = Mandate::findOrFail($id);

        $this->updateItem($mandate, Mandate::class, "Mandate");
        // $this->updateItem($mandate, Mandate::class, "Mandate", "mandate_show");

        Notification::send($mandate->contributors, new ItemNotification($mandate, $mandate::$module, "mandate_show", $mandate->id));
        // Notification::send($this->notifyApprovers($mandate), new MandateStatusChange($mandate));


        return [
            'item_id' => $mandate->id,
            'success_text' => "Mandate " . $mandate->code . " has been successfully updated"
        ];
    }

    // NON CRUD METHODS:

    public function returnToUser(Request $request)
    {

        // Return Mandate  
        $remark = $this->return($request, Mandate::class, "Mandate");

        // Send Notification
        $returned_to = User::findOrFail($remark->returned_to_id);

        Notification::send($remark->returned_to, new ItemNotification($remark->remarkable, $remark->remarkable::$module, "mandate_show", $remark->remarkable->id));

        return [
            'item_id' => $remark->remarkable->id,
            'success_text' => "Mandate " . $remark->remarkable->code . " has been successfully Returned"
        ];
    }

    public function reject($id)
    {
        $mandate = Mandate::findOrFail($id);

        $rejected_mandate = $this->rejectItem($mandate, "Mandate");


        // Send Notification to Contribution List 
        $returned_to = User::findOrFail($remark->returned_to_id);

        Notification::send($rejected_mandate->contributors, new ItemNotification($rejected_mandate, $rejected_mandate::$module, "mandate_show"));
    }
}
