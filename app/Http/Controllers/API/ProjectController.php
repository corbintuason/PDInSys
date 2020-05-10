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
use App\Notifications\ProjectReturned;
use App\Traits\ProjectsTrait;

class ProjectController extends Controller
{

    use ProjectsTrait;

    public function index()
    {
        return ProjectResource::collection(Project::all());
    }

    public function store(Request $request)
    {

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

        $project = $this->createItem($request, Project::class, "Project", "project_show");

        // Notify Process Users
        // Notification::send($this->notifyApprovers($project), new ProjectCreated($project));

        return [
            'item_id' => $project->id,
            'success_text' => "Project " . $project->code . " has been successfully created"
        ];
    }

    public function show($id)
    {
        return new ProjectResource(Project::findorFail($id));
    }

    public function update($id)
    {
        $project = Project::findOrFail($id);
        $auth_user = auth()->user();

        $this->updateItem($project, Project::class, "Project", "project_show");


        return [
            'item_id' => $project->id,
            'success_text' => "Project " . $project->code . " has been successfully updated"
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
        $project = $remark->remarkable;
        activity()->withoutLogs(function () use ($project, $request) {
            $project->update([
                'status' => 'Returned to ' . $request['user']['responsibility']
            ]);
        });

        $returned_to = User::findOrFail($remark->returned_to_id);
        Notification::send($returned_to, new ProjectReturned($project));

        activity('Project Returned')
            ->on($project)
            ->log($auth_user->full_name . " has returned Project Code " . $project->code . " to " . $returned_to->full_name);

        return [
            'item_id' => $project->id,
            'success_text' => "Project " . $project->code . " has been successfully Returned"
        ];
    }
}
