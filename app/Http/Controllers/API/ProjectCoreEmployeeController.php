<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectCoreEmployee;
use App\Http\Resources\ProjectCoreEmployee as ProjectCoreEmployeeResource; 
use Notification;
use App\Notifications\ProjectCoreEmployeeAssigned;
use App\Notifications\ProjectStatusChange;
use App\User;
Use App\Project;
class ProjectCoreEmployeeController extends Controller
{

    public function store(Request $request){
        $validatedData = $request->validate([
            'project_id' => 'required',
            'user_id' => 'required',
            'team' => 'required',
            'type' => 'required',
            'score_percentage' => 'required'
        ]);

        $project_core_employee = activity()->withoutLogs(function() use($request){
            return ProjectCoreEmployee::create($request->all());
        });

        $employee = User::findOrFail($project_core_employee->user_id);
        $project = Project::findOrFail($project_core_employee->project_id);

        Notification::send($employee, new ProjectCoreEmployeeAssigned($employee, $project));
            // Create Activity Log
        

            activity('Employee Assigned to Project')
            ->on($project)
            ->withProperties(["link_name" => "project_show", "link_id" => $project_core_employee->project_id])
            ->log("User " . $employee->last_name .", " . $employee->first_name  . " has been assigned in Project Code" . $project->code . " with a role of " . $project_core_employee->type);

            if($project->isAssignmentComplete){
            activity()->withoutLogs(function() use($project){
                $project->update([
                    'status' => 'Assigned'
                ]);
            });
            // Notify Everyone in the contribution list that the project is completely assigned
            $contributor_ids = $project->contributors->pluck('user.id');
            $contributors = User::whereIn('id', $contributor_ids)->get();
            Notification::send($contributors, new ProjectStatusChange($project));
        }

        return new ProjectCoreEmployeeResource($employee);

    }
}
