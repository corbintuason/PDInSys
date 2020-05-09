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
use App\Traits\MandatesTrait;

class MandateController extends Controller
{
    use MandatesTrait;

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
        $mandate = $this->createItem($request, Mandate::class, "Mandate");
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
        $this->validate($request, [
            'status' => 'required|string|max:191',
        ]);
        $mandate = Mandate::findOrFail($id);
        $user_id = auth()->user()->id;
        $user = new UserResource(User::findOrFail($user_id));

        $old_status = $mandate->status;
        activity()->withoutLogs(function () use ($mandate, $request) {
            $mandate->update([
                'status' => $request['status'],
            ]);
        });


        // Notify the creator that the mandate has been approved
        $update_user = User::findOrFail($mandate->creator_id);
        $update_users = collect([]);
        $update_users->push($update_user);
        Notification::send($update_users, new MandateStatusChange($mandate));

        // Create Activity Log

        activity('Mandate Status Change')
            ->on($mandate)
            ->withProperties(["link_name" => "mandate_show", "link_id" => $mandate->id])
            ->log("User " . $user->last_name . ", " . $user->first_name  . " has changed Mandate " . ' ' . $mandate->code . " status from " . $old_status . " to " . $mandate->status);


        return new MandateResource($mandate);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Mandate  $mandate
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mandate $mandate)
    {
        //
    }
}
