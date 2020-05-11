<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Mandate as MandateResource;
use App\Http\Resources\User as UserResource;
use App\Mandate;
use App\MandateContributor;
use App\User;
use Notification;
use App\Notifications\MandateCreated;
use App\Notifications\MandateStatusChange;
use App\Remark;
use App\Contributor;
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

        // STATUS IS SET TO FOR APPROVAL
        $auth_user = auth()->user();
        $mandate = $this->createItem($request, Mandate::class, "Mandate", "mandate_show");
        // Notify Process Users
        Notification::send($this->notifyApprovers($mandate), new MandateCreated($mandate));

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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Mandate  $mandate
     * @return \Illuminate\Http\Response
     */
    public function edit(Mandate $mandate)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Mandate  $mandate
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $mandate = Mandate::findOrFail($id);
        $auth_user = auth()->user();

        $this->updateItem($mandate, Mandate::class, "Mandate", "mandate_show");

        // Notify Process Users
        Notification::send($this->notifyApprovers($mandate), new MandateStatusChange($mandate));

        return [
            'item_id' => $mandate->id,
            'success_text' => "Mandate " . $mandate->code . " has been successfully updated"
        ];
    }

    public function returnToUser(Request $request, $id)
    {
        $auth_user = auth()->user();
        $remark = Remark::create([
            'remarkable_type' => "App\\" . $request['remarkable_type'],
            'remarkable_id' => $request['remarkable_id'],
            'returned_to_id' => $request['user']['id'],
            'returned_by_id' => $auth_user->id,
            'remarks' => $request['remarks']
        ]);
        $mandate = $remark->remarkable;
        activity()->withoutLogs(function () use ($mandate, $request) {
            $mandate->update([
                'status' => 'Returned to ' . $request['user']['responsibility']
            ]);
        });

        $returned_to = User::findOrFail($remark->returned_to_id);
        Notification::send($returned_to, new MandateReturned($mandate));

        activity('Mandate Returned')
            ->on($mandate)
            ->log($auth_user->full_name . " has returned Mandate Code " . $mandate->code . " to " . $returned_to->full_name);

        return [
            'item_id' => $mandate->id,
            'success_text' => "Mandate " . $mandate->code . " has been successfully Returned"
        ];
    }
}
