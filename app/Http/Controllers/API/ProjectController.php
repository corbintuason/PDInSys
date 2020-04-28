<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Project;
use App\User;
use App\ProjectContributor;
use App\Http\Resources\Project as ProjectResource;
use App\Notifications\ProjectCreated;
use App\Notifications\ProjectStatusChange;
use App\Http\Resources\User as UserResource;
use Notification;
use \stdclass;
use Bouncer;
use App\Remark;
use App\Notifications\ProjectReturned;

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
        $status = 'For Review';
        
        // Create Project
        $project = activity()->withoutLogs(function() use($request, $status){
        $new_project = $request->toArray();
        $new_project['status'] = $status;
        return Project::create($new_project);
        });

        // Add Project Contributor List
        
        $project_contributor = ProjectContributor::create([
            'project_id' => $project->id,
            'contributor_id' => $auth_user->id,
            'responsibility' => "Creator"
        ]);

        // Bouncer::allow($auth_user)->to('see', $project);

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
            if($project->status == 'For Approval' || $project->status== 'Approved') {
                if($request['status']=='For Approval'){
                    ProjectContributor::create([
                        'project_id' => $project->id,
                        'contributor_id' => $auth_user->id,
                        'responsibility' => "Reviewer"
                    ]);
                    $approvers = User::whereIs('project-approver')->get();
                    Notification::send($approvers, new ProjectStatusChange($project));
                }else if ($request['status'] =='Approved'){
                    $project_contributor = ProjectContributor::create([
                        'project_id' => $project->id,
                        'contributor_id' => $auth_user->id,
                        'responsibility' => "Approver"
                    ]);
                    $assigners = User::whereIs('project-assigner')->get();
                    Notification::send($assigners, new ProjectStatusChange($project));
                }
                // Create Activity Log
                activity('Project Status Change')
                ->on($project)
                ->withProperties(["link_name" => "project_show", "link_id" => $project->id])
                ->log("User " . $auth_user->last_name .", " . $auth_user->first_name  . " has changed Account " . $project->name . "'s status from ". $old_status . " to ". $project->status);

            } else if($project->status == 'Returned'){
                $remark = Remark::create([
                    'remarkable_type' => "App\\". $request['remarkable_type'],
                    'remarkable_id' => $request['remarkable_id'],
                    'returned_to_id' => $request['user']['id'],
                    'returned_by_id' => $auth_user->id,
                    'remarks' => $request['remarks']
                ]);
                $returned_to = User::findOrFail($remark->returned_to_id);                
                Notification::send($returned_to, new ProjectReturned($project));

                activity('Project Returned')
                ->on($project)
                ->withProperties(["link_name" => "project_show", "link_id" => $project->id])
                ->log("User ". $auth_user->full_name . " has returned Project Code ". $project->code . " to " . $returned_to->full_name);

            } else if($project->status == 'Rejected'){
                activity('Project Rejected')
                ->on($project)
                ->withProperties(["link_name" => "project_show", "link_id" => $project->id])
                ->log("User ". $auth_user->full_name . " has rejected Project Code ". $project->code . ".");

            }
            
           
        
    
        return new ProjectResource($project);
        //
    }

}
