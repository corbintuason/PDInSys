<?php

namespace App\Traits;

use App\Project;
use Illuminate\Http\Request;
use App\Traits\ControllersTrait;

trait ProjectsTrait
{

    use ControllersTrait;

    // public function notifyUsers(Project $project){
    //     $status = $project->status;
    //     $notify;
    //     if($status == 'For Review'){
    //         $notify = 'project-reviewer';
    //     }
    //     return $notify;
    // }
}
