<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\CostEstimate;
use App\CostEstimateDetail;
use Storage;
use App\Project;
use App\Http\Resources\User as UserResource;
use App\User;
use Notification;
use App\Contributor;
use App\Notifications\CostEstimateCreated;
use App\Notifications\CostEstimateStatusChange;
class CostEstimateController extends Controller
{
    use ControllersTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CostEstimate::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id)
    {
        $auth_user = auth()->user();
        $extension = $request->file('file')->extension();
        $full_name = $request->input('name').'.'.$extension;
        $path = Storage::putFileAs(
            'cost-estimates', $request->file('file'), $full_name
        );
        
        $cost_estimate = activity()->withoutLogs(function() use($request, $full_name, $id){
           return CostEstimate::create([
                'name' => $full_name,
                'project_id' => $id,
                'status' => $request->input('status')
                ]);
        });

        // Create Cost Estimate Details
        // $details = json_decode($request->get('details'), true);
        // foreach($details as $detail){
        //     CostEstimateDetail::create([
        //         'cost_estimate_id' => $cost_estimate->id,
        //         'sub_total' => $detail['sub_total'],
        //         'version' => $detail['version'],
        //         'asf_rate' => $detail['asf_rate'],
        //         'peza_ar' => $detail['peza_ar']
        //     ]);
        // }

        // Add Contributor
        // Add Project Contributor List
        //    if($cost_estimate->status == "For Review"){
        //     $responsibility = "Creator";
        //     $notify = "cost-estimate-reviewer";
        // }else if($cost_estimate->status == "For Approval"){
        //     $responsibility = "Reviewer";
        //     $notify = "cost-estimate-approver";
        // }else if ($cost_estimate->status == "For Clearance"){
        //     $responsibility = "Approver";
        //     $notify = "cost-estimate-clearer"; 
        // }

        // $cost_estimate_contributor = Contributor::create([
        //     'contributable_type' => "App\\CostEstimate",
        //     'contributable_id' => $cost_estimate->id,
        //     'contributor_id' => $auth_user->id,
        //     'responsibility' => $responsibility
        // ]);

        // $notify_users = User::whereIs($notify)->get();
        // Notification::send($notify_users, new CostEstimateCreated($cost_estimate));
        // Create Activity Log
        
        // activity('Cost Estimate Created')
        // ->on($cost_estimate)
        // ->log($auth_user->full_name . " has created " . $cost_estimate->code);
        
        return [
            'refresh' => true,
            'success_text' => $cost_estimate->code . " has been successfully created."
        ];

        


        


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $headers = [
        'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ];

        $cost_estimate = CostEstimate::findOrFail($id);
        return Storage::download("cost-estimates/".$cost_estimate->name, "trial.xlsx", $headers);

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
        $project = Project::findOrFail($id);
        $cost_estimate = $project->cost_estimate;

        $auth_user = new UserResource(User::findOrFail(auth()->user()->id));

        activity()->withoutLogs(function() use($cost_estimate, $request){
             $cost_estimate->update($request->all());
        });
        
        if($cost_estimate->status == "For Review"){
            $responsibility = "Creator";
            $notify = "cost-estimate-reviewer";
            $log = $auth_user->full_name . " has changed Cost Estimate's status to ". $cost_estimate->status;
        }else if($cost_estimate->status == "For Approval"){
            $responsibility = "Reviewer";
            $notify = "cost-estimate-approver";
            $log = $auth_user->full_name . " has changed Cost Estimate's status to ". $cost_estimate->status;
        }else if ($cost_estimate->status == "For Clearance"){
            $responsibility = "Approver";
            $notify = "cost-estimate-clearer"; 
            $log = $auth_user->full_name . " has changed Cost Estimate's status to ". $cost_estimate->status;
        }else if ($cost_estimate->status == "Cleared"){
            $responsibility = "Clearer";
            $notify = "cost-estimate-clearer"; 
            $log = $auth_user->full_name . " has changed Cost Estimate's status to ". $cost_estimate->status;
        }

          // Create Activity Log
          activity('Cost Estimate Status Change')
          ->on($cost_estimate)
          ->log($log);

          $contributor_exists = Contributor::where('contributable_type', "App\\CostEstimate")
          ->where('contributable_id', $cost_estimate->id)
          ->where('responsibility', $responsibility)
          ->get()->isEmpty();

          if($contributor_exists){
            $cost_estimate_contributor = Contributor::create([
                'contributable_type' => "App\\CostEstimate",
                'contributable_id' => $cost_estimate->id,
                'contributor_id' => $auth_user->id,
                'responsibility' => $responsibility
            ]);
        }
        
        $notify_users = User::whereIs($notify)->get();
        Notification::send($notify_users, new CostEstimateStatusChange($cost_estimate));
        
        return [
            'item_id' => $cost_estimate->project->id,
            'success_text' => "Project " . $cost_estimate->project->code . "'s CE has been successfully updated"
        ];

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
