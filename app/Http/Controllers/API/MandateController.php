<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Mandate as MandateResource;
use App\Http\Resources\User as UserResource;
use App\Mandate;
use App\User;

class MandateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return MandateResource::collection(Mandate::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        // STATUS IS SET TO FOR APPROVAL
        $user = new UserResource(User::findOrFail($request->creator_id));
        $date_today = date('Y/m/d');
        $status = "For Approval";
        $change_log = [$date_today . ": User " . $user->last_name . " has created this mandate"];

        $mandate = Mandate::create([
            'date' => $request['date'],
            'position' => $request['position'],
            'full_name' => $request['full_name'],
            'region' => $request['region'],
            'permanent_address' => $request['permanent_address'],
            'present_address' => $request['present_address'],
            'gender' => $request['gender'],
            'civil_status' => $request['civil_status'],
            'birthdate' => $request['birthdate'],
            'age' => $request['age'],
            'mobile_number' => $request['mobile_number'],
            'telephone_number' => $request['telephone_number'],
            'religion' => $request['religion'],
            'sss_number' => $request['sss_number'],
            'tin_number' => $request['tin_number'],
            'pagibig_number' => $request['pagibig_number'],
            'philhealth_number' => $request['philhealth_number'],
            'passport_number' => $request['passport_number'],
            'tertiary_details' => $request['tertiary_details'],
            'secondary_details' => $request['secondary_details'],
            'primary_details' => $request['primary_details'],
            'work_details' => $request['work_details'],
            'father_details' => $request['father_details'],
            'mother_details' => $request['mother_details'],
            'spouse_details' => $request['spouse_details'],
            'emergency_details' => $request['emergency_details'],
            'status' => $status,
            'creator_id' => $request['creator_id'],
            'change_logs' => $change_log
        ]);

        return new MandateResource($mandate);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Mandate  $mandate
     * @return \Illuminate\Http\Response
     */
    public function show(Mandate $mandate)
    {
        //
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
    public function update(Request $request, Mandate $mandate)
    {
        //
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
