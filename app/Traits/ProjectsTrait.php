<?php
namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\CommonTrait;

trait ProjectsTrait {

    use CommonTrait;
    public function getCreateStatus(Request $request) {
        $roles = auth()->user()->getRoles()->toArray();
        $next_status;
        if(in_array('project-creator', $roles)){
            $next_status = "For Review";
        }else if (in_array('project-reviewer', $roles)){
            $next_status = "For Approval";
        }else if (in_array('project-approver', $roles)){
            $next_status = "For Assigning";
        }
        return $next_status;
    }

    // public function notifyUsers(Project $project){
    //     $status = $project->status;
    //     $notify;
    //     if($status == 'For Review'){
    //         $notify = 'project-reviewer';
    //     }
    //     return $notify;
    // }
}