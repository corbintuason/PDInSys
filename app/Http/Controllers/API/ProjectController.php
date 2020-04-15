<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use App\Project;
use App\Http\Resources\Project as ProjectResource;

class ProjectController extends Controller
{
    public function index(){
        return ProjectResource::collection(Project::all());
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required',
            'account' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'locations' => 'required',
            'status' => 'required',
            'score' => 'required',
            'for_project_bidding' => 'required',
            'departments_needed' => 'required',
        ]);

        // Create Involved Users Object
        $involved_users = new stdClass();
        $involved_users->creator_id = auth()->user()->id;
        
    }

}
