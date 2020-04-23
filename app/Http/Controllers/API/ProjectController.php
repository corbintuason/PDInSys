<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Project;
use App\User;
use App\Http\Resources\Project as ProjectResource;
use App\Notifications\ProjectCreated;
use App\Notifications\ProjectStatusChange;
use App\Http\Resources\User as UserResource;
use Notification;
use \stdclass;

class ProjectController extends Controller
{
    public function index(){
        return ProjectResource::collection(Project::all());
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'project_status' => 'required',
            'account' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'locations' => 'required',
            'score' => 'required',
            'for_project_bidding' => 'required',
            'departments_needed' => 'required',
        ]);
        
        $auth_user = auth()->user();
        $involved_users = array();
        $creator = new stdClass;
        $creator->type = "Creator";
        $creator->id = $auth_user->id;
        array_push($involved_users, $creator);
        $status = 'For Review';
        
        // Create Project
        $project = activity()->withoutLogs(function() use($request, $status, $involved_users){
        $new_project = $request->toArray();
        $new_project['status'] = $status;
        $new_project['involved_users'] = $involved_users;
        return Project::create($new_project);
        });

        // Set Project Code
        $project = activity()->withoutLogs(function() use($project){
            $project_id = $project->id;
            $curr_year = date("y");
            $project->code = $curr_year . "-" . $project_id;
            $project->save();
            return $project;
        });
      

          // Notify all Accounts that can Approve this Project
        $approvers = User::whereIs('project-reviewer')->get();
        Notification::send($approvers, new ProjectCreated($project));

        // Create Activity Log
        
        activity('Project Created')
        ->on($project)
        ->withProperties(["link_name" => "project_show", "link_id" => $project->id])
        ->log("User " . $auth_user->last_name .", " . $auth_user->first_name  . " has created Project " . $project->name);

        return new ProjectResource($project);

    }

    public function show($id)
    {
        return new ProjectResource(Project::findorFail($id));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'status' => 'required|string|max:191',
        ]);
        $project = Project::findOrFail($id);
        $user_id = auth()->user()->id;
        $auth_user = new UserResource(User::findOrFail($user_id));
        
        $old_status = $project->status;
        activity()->withoutLogs(function() use($project, $request){
            $project->update([
                'status' => $request['status'],
            ]);
        });
        
        // Past Involved Users 
        $update_users = collect([]);

        // If status updated to 'For Approval'
        $involved_users = $project->involved_users;
        switch($request['status']){
            case 'For Approval': {
                $reviewer = new stdClass;
                $reviewer->type = "Reviewer";
                $reviewer->id = $auth_user->id;
                array_push($involved_users, $reviewer);
                activity()->withoutLogs(function() use($project, $involved_users){
                    $project->update([
                        'involved_users' => $involved_users,
                    ]);
                });
                $approvers = User::whereIs('project-approver')->get();
                $update_users = $update_users->merge($approvers);
            } break;
            case 'Approved': {
                $approver = new stdClass;
                $approver->type = "Approver";
                $approver->id = $auth_user->id;
                array_push($involved_users, $approver);
                activity()->withoutLogs(function() use($project, $involved_users){
                    $project->update([
                        'involved_users' => $involved_users,
                    ]);
                });
                $assigners = User::whereIs('project-assigner')->get();
                $update_users = $update_users->merge($assigners);
            } break;
        }
       
        Notification::send($update_users->unique(), new ProjectStatusChange($project));
         // Create Activity Log
         activity('Project Status Change')
         ->on($project)
         ->withProperties(["link_name" => "project_show", "link_id" => $project->id])
         ->log("User " . $auth_user->last_name .", " . $auth_user->first_name  . " has changed Account " . $project->name . "'s status from ". $old_status . " to ". $project->status);
 

        return new ProjectResource($project);
        //
    }

}
