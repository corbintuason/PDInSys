<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ProjectCoreEmployee;
use App\Http\Resources\ProjectCoreEmployee as ProjectCoreEmployeeResource; 
class ProjectCoreEmployeeController extends Controller
{
    public function index(){
        return "hola";
    }

    public function store(Request $request){
        $validatedData = $request->validate([
            'project_id' => 'required',
            'user_id' => 'required',
            'type' => 'required',
            'score_percentage' => 'required'
        ]);
        $employee = ProjectCoreEmployee::create($request->all());
        
        return new ProjectCoreEmployeeResource($employee);

    }
}
