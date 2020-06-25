<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Project;
use App\User;
use App\Contributor;
use App\Http\Resources\Project as ProjectResource;
use App\Notifications\ProjectCreated;
use App\Notifications\ProjectStatusChange;
use App\Http\Resources\User as UserResource;
use Notification;
use \stdclass;
use Bouncer;
use App\Remark;
use App\Notifications\ItemNotification;
use App\Traits\ControllersTrait;

class ProjectController extends Controller
{

    use ControllersTrait;

    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'name' => 'required',
            'client_id' => 'required',
            'department_id' => 'required',
            'brand_id' => 'required',
            'project_status' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'locations' => 'required',
            'score' => 'required',
            'for_project_bidding' => 'required',
            'departments_needed' => 'required',
        ]);
        
        $project = $this->createItem($request, Project::class, "Project", "project_show", true);

        Notification::send($this->notifyApprovers($project), new ItemNotification($project, $project::$module, "project_show", $project->id));

        return [
            'item_id' => $project->id,
            'success_text' => "Project " . $project->code . " has been successfully created"
        ];
    }

    public function show($id)
    {
        return new ProjectResource(Project::findorFail($id));
    }

    public function update(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $this->updateItem($project, Project::class, "Project", "project_show");

        if($request->get("skipped")){
            $this->skipRemark($project, Project::class);
        }

        return [
            'item_id' => $project->id,
            'success_text' => "Project " . $project->code . " has been successfully updated"
        ];
        
    }

    public function returnToUser(Request $request, $id)
    {
         // Return Account  
         $remark = $this->return($request, Project::class, "Project");
        
         // Send Notification
         $returned_to = User::findOrFail($remark->returned_to_id);
 
         Notification::send($remark->returned_to, new ItemNotification($remark->remarkable, $remark->remarkable::$module, "project_show", $remark->remarkable->id));
 
         return [
             'item_id' => $remark->remarkable->id,
             'success_text' => "Project " . $remark->remarkable->code . " has been successfully Returned"
         ];
    }

    public function saveChanges(Request $request, $id){
        // Update First the Cost Estimate Detail
        $project = Project::findOrFail($id);
        $updated_project = $this->saveChangesToItem($request, Project::class, $project, "Project");
        
        Notification::send($this->notifyApprovers($updated_project), new ItemNotification($updated_project, $updated_project::$module, "project_show", $updated_project->id));

        return [    
            'refresh' => true,
            'success_text' => $project->code . " has been successfully edited.",
        ];
    }
}
