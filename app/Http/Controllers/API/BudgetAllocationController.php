<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\BudgetAllocation;
use App\Http\Resources\BudgetAllocation as BudgetAllocationResource;



class BudgetAllocationController extends Controller
{

    public function index()
    {
        return BudgetAllocationResource::collection(BudgetAllocation::all());
    }
}
